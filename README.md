This is a proof of concept of a 100% GDPR compliant implementation of Google Analytics through a Wordpress plugin.

Making GA GDPR compliant poses a few problems since anytime a web browser picks up the default library on Google's servers their IP address is sent, which causes a personal data processing, therefore making GDPR apply.

To avoid any personal data processing we implement GA on the backend, so nothing from the client is sent directly.

In order to ensure complete anonymity of the client - we create an anonymous ID that Google will not be able to de-anonymize.

This is mostly a proof of concept but it happens to work.
