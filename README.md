# IP's Buy on request plugin

## Installation

Plugin should be installed according to the standard plugin installation - either via console or the backend of the shop.

During the installation, custom field is created alongside the required custom field set.

Note: during installation we check if the field is already existing or not. It makes the work with DB dumps easier.

## Usage

After installing and activating, following changes are present:
* In the administration you will find the new custom field for products that can be switched either off and on (off by default)
* If the switch is active, the buy button for this product is deactivated and the caption of the button is changed
* Also the plugin checks every basket for the presence of such products and removes them, notifying about it via error message
* Plugin also presents an additional API endpoint for retrieving the state of the switch for an individual item.