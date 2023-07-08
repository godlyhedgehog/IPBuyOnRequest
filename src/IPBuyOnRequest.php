<?php declare(strict_types=1);

namespace IPBuyOnRequest;

use Shopware\Core\Defaults;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsAnyFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\System\CustomField\CustomFieldTypes;

class IPBuyOnRequest extends Plugin
{
    const SET_NAME = "IPBuyOnRequest_field_set";
    const FIELD_NAME = "IPBuyOnRequest_cf_buy_on_request";

    public function install(InstallContext $installContext): void
    {
        $this->addCustomFields($installContext);
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        $this->removeCustomField($uninstallContext);
    }

    private function removeCustomField(UninstallContext $uninstallContext)
    {
        $customFieldSetRepository = $this->container->get('custom_field_set.repository');

        $fieldIds = $this->customFieldsExist($uninstallContext->getContext());

        if ($fieldIds) {
            $customFieldSetRepository->delete(array_values($fieldIds->getData()), $uninstallContext->getContext());
        }
    }

    private function customFieldsExist(Context $context)
    {
        $customFieldSetRepository = $this->container->get('custom_field_set.repository');

        $criteria = new Criteria();
        $criteria->addFilter(new EqualsAnyFilter('name', [self::SET_NAME]));

        $ids = $customFieldSetRepository->searchIds($criteria, $context);

        return $ids->getTotal() > 0 ? $ids : null;
    }

    private function addCustomFields(InstallContext $installContext): void
    {
        $fieldIds = $this->customFieldsExist($installContext->getContext());

        if ($fieldIds) {
            return;
        }

        $customFieldSetRepository = $this->container->get('custom_field_set.repository');
        $customFieldSetRepository->create([
            [
                'name' => self::SET_NAME,
                'config' => [
                    'label' => [
                        'en-GB' => 'Buy on request',
                        'de-DE' => 'Bestellbar auf Anfrage'
                    ]
                ],
                'relations' => [[
                    'entityName' => 'product'
                ]],
                'customFields' => [
                    [
                        'name' => self::FIELD_NAME,
                        'type' => CustomFieldTypes::SWITCH,
                        'config' => [
                            'label' => [
                                'en-GB' => 'Buy on request',
                                'de-DE' => 'Bestellbar auf Anfrage'
                            ],
                            'customFieldPosition' => 1
                        ]
                    ]
                ]
            ]
        ], $installContext->getContext());
    }

}