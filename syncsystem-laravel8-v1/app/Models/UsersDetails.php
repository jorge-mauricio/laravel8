<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Sanctum;

//use Laravel\Passport\HasApiTokens;

//class UsersDetails extends Model
class UsersDetails extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    // Properties.
    // ----------------------
    private float $idTbUsers = 0;
    private array|null $arrSearchParameters = null;

    private int $terminal = 0; // terminal: 0 - admin | 1 - frontend
    
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = null;

    private array|null $resultsUsersDetails = null; // TODO: double check - it may be mixed.
    private array|null $oudRecordParameters = null;

    protected mixed $objUsersDetails = null; // TODO: double check - it may be mixed.
    protected array|null $arrUsersListing = null;
    // ----------------------

    // Laravel attributes (necessary for creating Sanctum token).
    // ----------------------
    // protected $attributes = [
    //     'id' => 0,
    // ];
    // ----------------------

    // Laravel properties (necessary for creating Sanctum token).
    // ----------------------
    //public $table = 'prefix_ssmv1_users';
    // public string|null $table;
    public $table; // working
    //public $table = env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . $GLOBALS['configSystemDBTableUsers'];
    // ----------------------

    // Constructor.
    // TODO: include $terminal as constructor parameter (or some other method).
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $objParameters
     */
    public function __construct(?array $_oudRecordParameters = null)
    {
        $this->table = env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . $GLOBALS['configSystemDBTableUsers'];

        // Define values.
        if ($_oudRecordParameters !== null) {
            $this->oudRecordParameters = $_oudRecordParameters;

            $this->idTbUsers = isset($this->oudRecordParameters['_idTbUsers']) ? $this->oudRecordParameters['_idTbUsers'] : $this->idTbUsers;
            $this->attributes['id'] = $this->idTbUsers; // Laravel attribute (necessary for creating Sanctum token).
            // TODO: research if needs to change tokenable_type data (maybe point to the users table).
            //$this->table = 'prefix_ssmv1_users';
            //this->table = env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . $GLOBALS['configSystemDBTableUsers'];
        }

        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        } // TODO: evaluate moving this to a model base (extended).
    }
    // **************************************************************************************

    // Build content placeholder body.
    // TODO: eveluate changing name to build().
    // **************************************************************************************
    /**
     * Build content placeholder body.
     * @return array
     */
    public function cphBodyBuild(): array
    {
        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => false];
        // ----------------------

        // Logic.
        try {
            // Build object - details.
            if ($this->oudRecordParameters !== null) {
                $oudRecord = new \SyncSystemNS\ObjectUsersDetails($this->oudRecordParameters);
                $arrReturn['oudRecord'] = $oudRecord->recordDetailsGet(0, 1);

                if ($arrReturn['oudRecord']['returnStatus'] === true) {
                    $arrReturn['returnStatus'] = true;
                }
            }
        } catch (Error $cphBodyBuildError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('cphBodyBuildError: ' . $cphBodyBuildError->message());
            }
        } finally {
            //
        }
        
        //return 'content inside model: ' . $this->_idParent; // debug.
        return $arrReturn;
    }
    // **************************************************************************************

    /**
     * Override getAuthIdentifier() method to return the user ID.
     * @return mixed
     */
    // public function getAuthIdentifier()
    // {
    //     return $this->idTbUsers;
    // }
    

    // public function tokens()
    // {
    //     //return $this->morphMany(Sanctum::$personalAccessTokenModel, 'tokenable', "tokenable_type", "tokenable_id");
    //     return $this->morphMany(Sanctum::$personalAccessTokenModel, 'tokenable', 'tokenable_type', 'tokenable_id');
    //     //idTbUsers
    // }

    // Override createToken method.
    // **************************************************************************************
    /**
     * Override createToken method.
     */
    // public function createToken(string $name, array $abilities = ['*'])
    // {
    //     $userId = $userId ?? $this->getKey();

    //     $token = $this->tokens()->create([
    //         'name' => $name,
    //         'token' => hash('sha256', $plainTextToken = Str::random(40)),
    //         'abilities' => $abilities,
    //         'tokenable_id' => $userId,
    //         'tokenable_type' => get_class($this),
    //     ]);
    
    //     //return new NewAccessToken($token, $token->id.'|'.$plainTextToken);
    //     return new \Laravel\Sanctum\NewAccessToken($token, $token->id.'|'.$plainTextToken);
    // }    
    // **************************************************************************************
}
