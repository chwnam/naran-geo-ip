<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'Composer\\CaBundle\\CaBundle' => $vendorDir . '/composer/ca-bundle/src/CaBundle.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'GeoIp2\\Database\\Reader' => $vendorDir . '/geoip2/geoip2/src/Database/Reader.php',
    'GeoIp2\\Exception\\AddressNotFoundException' => $vendorDir . '/geoip2/geoip2/src/Exception/AddressNotFoundException.php',
    'GeoIp2\\Exception\\AuthenticationException' => $vendorDir . '/geoip2/geoip2/src/Exception/AuthenticationException.php',
    'GeoIp2\\Exception\\GeoIp2Exception' => $vendorDir . '/geoip2/geoip2/src/Exception/GeoIp2Exception.php',
    'GeoIp2\\Exception\\HttpException' => $vendorDir . '/geoip2/geoip2/src/Exception/HttpException.php',
    'GeoIp2\\Exception\\InvalidRequestException' => $vendorDir . '/geoip2/geoip2/src/Exception/InvalidRequestException.php',
    'GeoIp2\\Exception\\OutOfQueriesException' => $vendorDir . '/geoip2/geoip2/src/Exception/OutOfQueriesException.php',
    'GeoIp2\\Model\\AbstractModel' => $vendorDir . '/geoip2/geoip2/src/Model/AbstractModel.php',
    'GeoIp2\\Model\\AnonymousIp' => $vendorDir . '/geoip2/geoip2/src/Model/AnonymousIp.php',
    'GeoIp2\\Model\\Asn' => $vendorDir . '/geoip2/geoip2/src/Model/Asn.php',
    'GeoIp2\\Model\\City' => $vendorDir . '/geoip2/geoip2/src/Model/City.php',
    'GeoIp2\\Model\\ConnectionType' => $vendorDir . '/geoip2/geoip2/src/Model/ConnectionType.php',
    'GeoIp2\\Model\\Country' => $vendorDir . '/geoip2/geoip2/src/Model/Country.php',
    'GeoIp2\\Model\\Domain' => $vendorDir . '/geoip2/geoip2/src/Model/Domain.php',
    'GeoIp2\\Model\\Enterprise' => $vendorDir . '/geoip2/geoip2/src/Model/Enterprise.php',
    'GeoIp2\\Model\\Insights' => $vendorDir . '/geoip2/geoip2/src/Model/Insights.php',
    'GeoIp2\\Model\\Isp' => $vendorDir . '/geoip2/geoip2/src/Model/Isp.php',
    'GeoIp2\\ProviderInterface' => $vendorDir . '/geoip2/geoip2/src/ProviderInterface.php',
    'GeoIp2\\Record\\AbstractPlaceRecord' => $vendorDir . '/geoip2/geoip2/src/Record/AbstractPlaceRecord.php',
    'GeoIp2\\Record\\AbstractRecord' => $vendorDir . '/geoip2/geoip2/src/Record/AbstractRecord.php',
    'GeoIp2\\Record\\City' => $vendorDir . '/geoip2/geoip2/src/Record/City.php',
    'GeoIp2\\Record\\Continent' => $vendorDir . '/geoip2/geoip2/src/Record/Continent.php',
    'GeoIp2\\Record\\Country' => $vendorDir . '/geoip2/geoip2/src/Record/Country.php',
    'GeoIp2\\Record\\Location' => $vendorDir . '/geoip2/geoip2/src/Record/Location.php',
    'GeoIp2\\Record\\MaxMind' => $vendorDir . '/geoip2/geoip2/src/Record/MaxMind.php',
    'GeoIp2\\Record\\Postal' => $vendorDir . '/geoip2/geoip2/src/Record/Postal.php',
    'GeoIp2\\Record\\RepresentedCountry' => $vendorDir . '/geoip2/geoip2/src/Record/RepresentedCountry.php',
    'GeoIp2\\Record\\Subdivision' => $vendorDir . '/geoip2/geoip2/src/Record/Subdivision.php',
    'GeoIp2\\Record\\Traits' => $vendorDir . '/geoip2/geoip2/src/Record/Traits.php',
    'GeoIp2\\Util' => $vendorDir . '/geoip2/geoip2/src/Util.php',
    'GeoIp2\\WebService\\Client' => $vendorDir . '/geoip2/geoip2/src/WebService/Client.php',
    'MaxMind\\Db\\Reader' => $vendorDir . '/maxmind-db/reader/src/MaxMind/Db/Reader.php',
    'MaxMind\\Db\\Reader\\Decoder' => $vendorDir . '/maxmind-db/reader/src/MaxMind/Db/Reader/Decoder.php',
    'MaxMind\\Db\\Reader\\InvalidDatabaseException' => $vendorDir . '/maxmind-db/reader/src/MaxMind/Db/Reader/InvalidDatabaseException.php',
    'MaxMind\\Db\\Reader\\Metadata' => $vendorDir . '/maxmind-db/reader/src/MaxMind/Db/Reader/Metadata.php',
    'MaxMind\\Db\\Reader\\Util' => $vendorDir . '/maxmind-db/reader/src/MaxMind/Db/Reader/Util.php',
    'MaxMind\\Exception\\AuthenticationException' => $vendorDir . '/maxmind/web-service-common/src/Exception/AuthenticationException.php',
    'MaxMind\\Exception\\HttpException' => $vendorDir . '/maxmind/web-service-common/src/Exception/HttpException.php',
    'MaxMind\\Exception\\InsufficientFundsException' => $vendorDir . '/maxmind/web-service-common/src/Exception/InsufficientFundsException.php',
    'MaxMind\\Exception\\InvalidInputException' => $vendorDir . '/maxmind/web-service-common/src/Exception/InvalidInputException.php',
    'MaxMind\\Exception\\InvalidRequestException' => $vendorDir . '/maxmind/web-service-common/src/Exception/InvalidRequestException.php',
    'MaxMind\\Exception\\IpAddressNotFoundException' => $vendorDir . '/maxmind/web-service-common/src/Exception/IpAddressNotFoundException.php',
    'MaxMind\\Exception\\PermissionRequiredException' => $vendorDir . '/maxmind/web-service-common/src/Exception/PermissionRequiredException.php',
    'MaxMind\\Exception\\WebServiceException' => $vendorDir . '/maxmind/web-service-common/src/Exception/WebServiceException.php',
    'MaxMind\\WebService\\Client' => $vendorDir . '/maxmind/web-service-common/src/WebService/Client.php',
    'MaxMind\\WebService\\Http\\CurlRequest' => $vendorDir . '/maxmind/web-service-common/src/WebService/Http/CurlRequest.php',
    'MaxMind\\WebService\\Http\\Request' => $vendorDir . '/maxmind/web-service-common/src/WebService/Http/Request.php',
    'MaxMind\\WebService\\Http\\RequestFactory' => $vendorDir . '/maxmind/web-service-common/src/WebService/Http/RequestFactory.php',
    'NGIP_Admin_Module' => $baseDir . '/core/interfaces/interface-ngip-admin-module.php',
    'NGIP_Admin_Settings' => $baseDir . '/includes/modules/admins/class-ngip-admin-settings.php',
    'NGIP_Admins' => $baseDir . '/includes/modules/class-ngip-admins.php',
    'NGIP_Callback_Exception' => $baseDir . '/core/exceptions/class-ngip-callback-exception.php',
    'NGIP_EJS_Queue' => $baseDir . '/core/etc/class-ngip-ejs-queue.php',
    'NGIP_Hook_Impl' => $baseDir . '/core/traits/trait-ngip-hook-impl.php',
    'NGIP_Main' => $baseDir . '/includes/class-ngip-main.php',
    'NGIP_Main_Base' => $baseDir . '/core/abstracts/abstract-ngip-main-base.php',
    'NGIP_Module' => $baseDir . '/core/interfaces/interface-ngip-module.php',
    'NGIP_Query_IP' => $baseDir . '/includes/modules/class-ngip-query-ip.php',
    'NGIP_Reg' => $baseDir . '/core/interfaces/interface-ngip-reg.php',
    'NGIP_Reg_Activation' => $baseDir . '/core/regs/class-ngip-reg-activation.php',
    'NGIP_Reg_Ajax' => $baseDir . '/core/regs/class-ngip-reg-ajax.php',
    'NGIP_Reg_Cron' => $baseDir . '/core/regs/class-ngip-reg-cron.php',
    'NGIP_Reg_Cron_Schedule' => $baseDir . '/core/regs/class-ngip-reg-cron-schedule.php',
    'NGIP_Reg_Deactivation' => $baseDir . '/core/regs/class-ngip-reg-dectivation.php',
    'NGIP_Reg_Meta' => $baseDir . '/core/regs/class-ngip-reg-meta.php',
    'NGIP_Reg_Option' => $baseDir . '/core/regs/class-ngip-reg-option.php',
    'NGIP_Reg_Post_Type' => $baseDir . '/core/regs/class-ngip-reg-post-type.php',
    'NGIP_Reg_Script' => $baseDir . '/core/regs/class-ngip-reg-script.php',
    'NGIP_Reg_Shortcode' => $baseDir . '/core/regs/class-ngip-reg-shortcode.php',
    'NGIP_Reg_Style' => $baseDir . '/core/regs/class-ngip-reg-style.php',
    'NGIP_Reg_Submit' => $baseDir . '/core/regs/class-ngip-reg-submit.php',
    'NGIP_Reg_Taxonomy' => $baseDir . '/core/regs/class-ngip-reg-taxonomy.php',
    'NGIP_Reg_Uninstall' => $baseDir . '/core/regs/class-ngip-reg-uninstall.php',
    'NGIP_Register' => $baseDir . '/core/interfaces/interface-ngip-register.php',
    'NGIP_Register_Ajax' => $baseDir . '/includes/registers/class-ngip-register-ajax.php',
    'NGIP_Register_Base_Activation' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-activation.php',
    'NGIP_Register_Base_Ajax' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-ajax.php',
    'NGIP_Register_Base_Cron' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-cron.php',
    'NGIP_Register_Base_Cron_Schedule' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-cron-schedule.php',
    'NGIP_Register_Base_Deactivation' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-deactivation.php',
    'NGIP_Register_Base_Option' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-option.php',
    'NGIP_Register_Base_Post_Type' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-post-type.php',
    'NGIP_Register_Base_Script' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-script.php',
    'NGIP_Register_Base_Style' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-style.php',
    'NGIP_Register_Base_Submit' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-submit.php',
    'NGIP_Register_Base_Taxonomy' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-taxonomy.php',
    'NGIP_Register_Base_Uninstall' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-uninstall.php',
    'NGIP_Register_Cron' => $baseDir . '/includes/registers/class-ngip-register-cron.php',
    'NGIP_Register_Cron_Schedule' => $baseDir . '/includes/registers/class-ngip-register-cron-schedule.php',
    'NGIP_Register_Option' => $baseDir . '/includes/registers/class-ngip-register-option.php',
    'NGIP_Register_Script' => $baseDir . '/includes/registers/class-ngip-register-script.php',
    'NGIP_Register_Style' => $baseDir . '/includes/registers/class-ngip-register-style.php',
    'NGIP_Register_Uninstall' => $baseDir . '/includes/registers/class-ngip-register-uninstall.php',
    'NGIP_Registers' => $baseDir . '/includes/modules/class-ngip-registers.php',
    'NGIP_Reigster_Base_Meta' => $baseDir . '/core/abstracts/registers/abstract-ngip-register-base-meta.php',
    'NGIP_Sciprt_Enqueue' => $baseDir . '/core/etc/class-ngip-script-enqueue.php',
    'NGIP_Settings' => $baseDir . '/includes/modules/class-ngip-settings.php',
    'NGIP_Submodule_Impl' => $baseDir . '/core/traits/trait-ngip-submodule-impl.php',
    'NGIP_Template_Impl' => $baseDir . '/core/traits/trait-ngip-template-impl.php',
    'NGIP_Updater' => $baseDir . '/includes/modules/class-ngip-updater.php',
);
