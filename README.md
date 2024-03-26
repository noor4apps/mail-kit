## Mail Kit

E-mail marketing system that stores your subscribers, and you can send emails to them, just like ConvertKit or MailChimp.
This project utilizes a Domain-Driven Design (DDD) approach to bridge the gap between business logic and code.

## features:

- Managing subscribers.
- Tagging them. Tags are helpful to filter subscribers when you want to send e-mails.
- Sending broadcast (or one-time) e-mails. You write the content, set the filters, and hit the Send button.
- Creating sequences. A sequence is a collection of e-mails delivered to subscribers after a certain delay. For example,
  you write four e-mails, and you want to send these e-mails in four weeks.
- You can create a sequence that does precisely that automatically. And the great thing about sequences is that they
  handle new subscribers as well. So if you create this sequence in February and a person subscribes in May, they will
  still be added to it and get one e-mail per week.
- Adding subscribers to sequences based on specific criteria. We can also create different filters.

## Domain-Driven Design (DDD)

DDD is a software development methodology that aims to align the language of the business domain with the code itself.

**Key Concepts:**

* Value Objects
* Data Transfer Objects
* Custom Query Builders
* Actions
* View Models
* Domains and Applications

The project leverages modern PHP features for efficient and maintainable code, including:

* Enumerations
* Read-only properties
* Factory methods
* Strategy design pattern

Additionally, contemporary web technologies like Inertia.js and Vue.js contribute to a smooth user experience and
streamlined development process.

## Running Tests

```shell
vendor/bin/phpunit
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
