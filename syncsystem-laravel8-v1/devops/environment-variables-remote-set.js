// Terminal: npm install -D @octokit/core
    // May require node 16
    // May not need
// Terminal: npm install -D @octokit/rest
    // May require node 18
// Terminal: npm install -D tweetsodium
    // deprecated
// Terminal: npm install -D libsodium-wrappers
    // Not sure if it worked // worked
// terminal: npm install -D sodium
    // Error visual studio 2015
// terminal: npm install libsodium-wrappers-sumo
    // Worked also, but better the upper one
// terminal: npm install -D dotenv
// Terminal: node environment-variables-remote-set.js | node devops/environment-variables-remote-set.js
// TODO: change file name to spine-case.
// TODO: create delete all secrets script.
// console.log('testing=', true);
// Note: Make sure all your .env file is present and variables are set with the correct values.

//require('dotenv').config();
const dotenv = require('dotenv');
dotenv.config(); // Load environment variables from .env file.
const fs = require('fs');
const path = require("path");

// const https = require('https');
// const { Octokit } = require("@octokit/core");
const { Octokit } = require("@octokit/rest");
const sodium = require('libsodium-wrappers');
//const sodium = require('libsodium-wrappers-sumo');

// Function to encrypt value for APIs.
// TODO: copy function to functions-crypto.
// **************************************************************************************
/**
 * Function to encrypt.
 * @static
 * @param {string} strValue
 * @param {integer} encryptAPIConfig { apiType: '', apiPublicKey: '' }
 * @returns {object} { returnStatus: false }
 * @example
 * let encryptValueForAPIResult = await encryptValueForAPI('testing encryption', {
 *      apiType: 'github-actions-secrets',
 *      apiPublicKey: 'key123abc'
 * });
 */
const encryptValueForAPI = async function(strValue, encryptAPIConfig = {}) {
  /*
      encryptAPIConfig = {
          apiType: '', // github-actions-secrets
          apiPublicKey: '' // for github-actions-secrets, should be the the key returned by the repo API
      }
  */

  // Variables.
  // ----------------------
  let objReturn = {
    returnStatus: false,
    encryptedValue: '',
    errorMessage: null
  };
  // ----------------------

  // Logic.
  if (strValue !== '') {
    try {
      // GitHub.
      // ----------------------
      // ref: https://docs.github.com/en/rest/guides/encrypting-secrets-for-the-rest-api?apiVersion=2022-11-28
      if (
        encryptAPIConfig.apiType === 'github-actions-secrets' &&
        encryptAPIConfig.apiPublicKey !== ''
      ) {
        // Note: encryptAPIConfig.apiPublicKey must be requested from the github API.
        await sodium.ready;

        // Convert the secret and key to a Uint8Array.
        const binkey = sodium.from_base64(encryptAPIConfig.apiPublicKey, sodium.base64_variants.ORIGINAL);
        const binsec = sodium.from_string(strValue);

        // Encrypt the secret using libsodium.
        const encBytes = sodium.crypto_box_seal(binsec, binkey);

        // Convert the encrypted Uint8Array to Base64.
        // const encrypted = sodium.to_base64(encBytes, sodium.base64_variants.ORIGINAL);
        objReturn.encryptedValue = sodium.to_base64(encBytes, sodium.base64_variants.ORIGINAL);
        objReturn.returnStatus = true;
      }
      // ----------------------
    } catch (e) {
      // TODO: Condition to debug.
      // TODO: evaluate creating an abstract function helper to handle the errors.
      console.error('encryptValueForAPI(error):', e.message);
      objReturn.errorMessage = e.message;
      objReturn.returnStatus = false;

      // Rethrow the error.
      // throw e;
    }
  }

  return objReturn;
};
// **************************************************************************************

// Function to encrypt value for APIs.
// TODO: copy function to functions-api.
// **************************************************************************************
/**
 * Function to encrypt.
 * @static
 * @param {string} strValue
 * @param {integer} apiDestinationConfig { apiType: '', user: '', repo: '', apiKeyID: null }
 * @returns {object} { returnStatus: false }
 * @example
 * let apiSetSecretResult = await apiSetSecret('secretKey', 'secretValue', {
 *     apiType: 'github-actions-secrets',
 *     user: 'owner',
 *     repo: 'repo-name',
 *      apiKeyID: 'key-from-api'
 * });
 */
const apiSetSecret = async function(secretKey, secretValue, apiDestinationConfig = {}) {
  // Variables.
  // ----------------------
  let objReturn = {
    returnStatus: false,
    encryptedValue: '',
    errorMessage: null
  };
  // ----------------------

  // Logic.
  if (
    apiDestinationConfig.secretKey !== '' &&
    apiDestinationConfig.secretValue !== ''
  ) {
    try {
      // GitHub.
      // ----------------------
      // ref: https://docs.github.com/en/rest/actions/secrets?apiVersion=2022-11-28#create-or-update-a-repository-secret
      if (
        apiDestinationConfig.apiType === 'github-actions-secrets' &&
        apiDestinationConfig.apiKeyID !== ''
      ) {
        // Note: secretValue must come encrypted (function encryptValueForAPI).
        // Note: apiDestinationConfig.apiKeyID must be required through GitHub API.
        await octokit.request(`PUT /repos/${apiDestinationConfig.user}/${apiDestinationConfig.repo}/actions/secrets/${secretKey}`, {
          owner: apiDestinationConfig.user,
          repo: apiDestinationConfig.repo,
          secret_name: secretKey,
          encrypted_value: secretValue,
          key_id: apiDestinationConfig.apiKeyID,
          // headers: {
          //     'X-GitHub-Api-Version': '2022-11-28'
          // } // working
        });
        // TODO: update logic (cleaner: https://stackoverflow.com/questions/76551512/injecting-a-github-secrets-into-the-user-repository)

        objReturn.returnStatus = true;
      }
      // ----------------------
    } catch (e) {
      // TODO: Condition to debug.
      // TODO: evaluate creating an abstract function helper to handle the errors.
      console.error('apiSetSecret(error):', e.message);
      objReturn.errorMessage = e.message;
      objReturn.returnStatus = false;

      // Rethrow the error.
      // throw e;
    }
  }

  return objReturn;
};
// **************************************************************************************

// Function to get environment variables from file in selected data object.
// TODO: copy function to functions-api.
// **************************************************************************************
/**
 * Function to encrypt.
 * @static
 * @param {string} envPath path to .env file
 * @param {integer} returnType 1 - key/value pair arrays
 * @returns {array|object|string}
 * @example
 * let apiSetSecretResult = getEnvironmentVariables();
 *     apiType: 'github-actions-secrets',
 *     user: 'owner',
 *     repo: 'repo-name',
 *      apiKeyID: 'key-from-api'
 * });
 */
const getEnvData = async (envFilePath, returnType = 1) => {
  /*
      returnType = 1
      [
          ['ENV_KEY1', 'envValue1'],
          ['ENV_KEY2', 'envValue2'],
          ['ENV_KEY3', 'envValue4'],
      ]
  */
  // Variables.
  // ----------------------
  dataReturn = null;
  // ----------------------

  if (envFilePath) {
    //
    if (returnType === 1) {
      dataReturn = [];

      // Function to filter out keys not present in .env
      const filterEnvKeys = (keys) => {
        const envKeys = Object.keys(process.env);
        const filteredKeys = keys.filter(key => envKeys.includes(key));
        return filteredKeys;
      };

      // Read the content of the .env file
      // const envPath = path.resolve(__dirname, '../.env'); // adjust the path as needed
      const envContent = fs.readFileSync(envFilePath, 'utf-8');

      // Split the content into lines and filter out comments
      const envLines = envContent
        .split('\n')
        .filter(line => !line.trim().startsWith('#') && !line.trim().startsWith('//'));

      // Extract keys from .env file
      const envKeys = envLines.map(line => line.split('=')[0]);

      // Filter and print only .env variables
      const filteredKeys = filterEnvKeys(envKeys);
      filteredKeys.forEach(key => {
        dataReturn.push([`${key}`, `${process.env[key]}`]);
        // Debug.
        // console.log(`${key}=${process.env[key]}`);
      });
    }
  }

  return dataReturn;
};
// **************************************************************************************


// Replace these values with your own.
// const GITHUB_USER = 'your-username';
// const GITHUB_REPO_NAME = 'your-repo';
// const GITHUB_TOKEN = 'your-personal-access-token';

// GitHub repo settings.
const GITHUB_USER = process.env.GITHUB_USER;
const GITHUB_REPO_NAME = process.env.GITHUB_REPO_NAME;
const GITHUB_TOKEN = process.env.GITHUB_TOKEN;
    // access_token-ftppipelinev1backendphplaravel8v1.ss.txt (restricted to repo)
// const GITHUB_TOKEN = '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';
    // access_token-ftppipelinev1phplaravel8v1.ss_classic.txt

// Variables.
let encryptValueForAPIResult = null;
let apiSetSecretResult = null;
let secretValueEncrypted = null;
let countKeysSuccessful = 0;

// Secrets (debug data).
// const arrSecrets = [];
// arrSecrets.push(['KEY_NAME1', 'secretValue1']);
// arrSecrets.push(['KEY_NAME2', 'secretValue2']);

// Oktakit.
// ref: https://octokit.github.io/rest.js/v20
const octokit = new Octokit({
  auth: GITHUB_TOKEN
});

(async () => {
  const { data: { key, key_id } } = await octokit.actions.getRepoPublicKey({
    owner: GITHUB_USER,
    repo: GITHUB_REPO_NAME
  });

  // Import variables form .env file.
  // let getEnvironmentVariablesTest = getEnvData(path.resolve(__dirname, '../.env'));
  const arrSecrets = await getEnvData(path.resolve(__dirname, '../.env'));

  // Loop through the key/value arrays.
  arrSecrets.forEach(async ([secretKey, secretValue]) => {
    // Encrypt secret value.
    encryptValueForAPIResult = await encryptValueForAPI(
      secretValue, {
        apiType: 'github-actions-secrets',
        apiPublicKey: key
      }
    );

    //
    if (encryptValueForAPIResult.returnStatus) {
      // Set encrypted.
      secretValueEncrypted = encryptValueForAPIResult.encryptedValue;

      // Set secret key/value.
      apiSetSecretResult = await apiSetSecret(secretKey, secretValueEncrypted, {
        apiType: 'github-actions-secrets',
        user: GITHUB_USER,
        repo: GITHUB_REPO_NAME,
        apiKeyID: key_id
      });
      if (apiSetSecretResult.returnStatus === true) {
        countKeysSuccessful++;
        console.log(`Secret key set successfully (${countKeysSuccessful}): `, secretKey);
      }
    }
  });
})();

// Debug.
// console.log('FRONTEND_FTP_PASSWORD=', process.env.FRONTEND_FTP_PASSWORD);
// console.log('FRONTEND_FTP_PASSWORD=', process.env);
// console.log('getEnvironmentVariablesTest=', getEnvironmentVariablesTest);
console.log('Copying .env variables to GitHub Actions Secrets...');
