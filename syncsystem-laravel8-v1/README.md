## SyncSystem - less code, more logic
A product owned by the company Planejamento Visual – Arte, Tecnologia e Comunicação – all rights reserved.

Development and conception carried out by [Jorge Mauricio (JM) – Full Stack Web Developer / Designer](https://www.fullstackwebdesigner.com) and company's head partner.

Any modification or implementation in the github code must be informed / consulted and approved with the company or the author.
The code is free for commercial and personal use, without the need of written or verbal authorization.

The developer provides professional training for better understanding of its architecture and use of the code.
Price quotes can be requested through the website: [SyncSystem - less code, more logic](https://www.syncsystem.com)

## SyncSystem Multiplatform
The goal of SyncSystem Multiplatform is to provide a robust boiler plate CMS framework to build MVP concepts in a variety of popular programming languages and technologies so it can be hosted on a different server setup, according to the developer's preference, while maintaining the basic architecture and design patterns.

At the moment, there are 2 main versions:
- Node / React SSR
- Laravel

### Brief History
SyncSystem is a modernization of a framework that had it's development started in the year of 2007, by the name of Sistema Dinâmico (Dynamic System) in a monolithic styled coding in Classic ASP.

The main trait was the aspect of being built with such an architecture that the developer could choose what type of content would be displayed in each link and had the ability to pivot whenever the project owner would request, with a relatively low effort. The links were characterized byt categories, which could have it's "type" switched. At the time, this feature was a game changer, as there were no CMS framework available yet and WordPress was barely being used.

Over the years, as the framework was used in over 50 real world project and exceeded most of the expectations on how fast the updates and new features were carried out, in 2012 it was time to update to modern languages at the time: .NET (VB.NET) and vanilla PHP, but still following the monolithic architecture paradigm.

After developing more then 100 real world projects, including e-commerce and social media platforms and adopting the new brand - SyncSystem, the industry had changed dramatically how applications were being built and the time had come to upgrade the framework intensely: distributed architecture in modern languages being used - Node / JavasCript / React.

In 2019, the transcription and re-structure began, along with internationalizing the code base and main language to english as up till that point, the architecture had been built in Brazilian portuguese. So, in reality, there are even more versions of SyncSystem available, as a few clients still asks for monolithic architecture application because of the low cost for implementation and maintenance:
- Classi ASP (monolithic, code base in PT-BR - deprecated)
- .NET / VB.NET (monolithic, code base in PT-BR)
- PHP - Vanilla (monolithic, code base in PT-BR)
- Node / React SSR (distributed backend / frontend, code base in EN-US)
- PHP - Laravel (distributed backend / frontend, code base in EN-US)

## PHP - Laravel Version
For the PHP version of SyncSystem, Laravel  was used as the architectural coding framework, to provide an industry preference for modern PHP applications.

Helper functions were built very similarly to the original concept so that heavy code translation can roll out smoothly.

### Tech Stack
- PHP 8
- MySQL
- Laravel 8
- JavaScript
- HTML5
- CSS3

## Setup
- Clone the repository to your local development environment;

### Server Variables File Setup (.env)
- Make a copy of .env.example with the name of .env;
- Update .env file, directories configuration section according to your preferences;
Note: leave it as is if you don't wish to change anything.
- Update .env file, cryptography section;
- Update .env file, API keys section;

### Aplication Config File Setup
- Edit config-application.php file according to your preferences;

### MySQL setup
- Create MySQL database instance;
- Store DB credential somewhere safe;
- Update .env file, in DB System section with the DB host, DB name, DB user and DB password;

### Local setup
- Terminal, run: `composer syncsystem:setup`

### Run locally
- Open 2 terminals;
- Terminal 1, run: `php -S localhost:8000 -t public/`
- Terminal 2, run: `php -S localhost:8001 -t public/`

### Production Deploy
- Server setup;

### Production Deploy (FTP - Automated Pipeline)
- [Instructions for creating a simple automated pipeline](https://github.com/jorge-mauricio/ftppipelinev1phplaravel8v1.syncsystem.com.br/blob/main/README.md)

## Resources
- SyncSystem - less code, more logic [Website](https://www.syncsystem.com.br)
- Jorge Mauricio (JM) – Full Stack Web Developer / Designer [Website](https://www.fullstackwebdesigner.com)

## Contributing

For contribution, open a pull request.

## Security Vulnerabilities

If you discover a security vulnerability within SyncSystem, please send an e-mail to JM via [contact@fullstackwebdesigner.com](mailto:contact@fullstackwebdesigner.com).

## License

The SyncSystem Multiplatform framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
