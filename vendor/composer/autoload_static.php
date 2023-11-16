<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1fc226ac333637e08afbf14b104abf77
{
    public static $files = array (
        'c2491120bada426dd10032fe0a98b960' => __DIR__ . '/../..' . '/core/core-functions.php',
        '8254ae23bd299868d72f900776c8b3a1' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MaxMind\\WebService\\' => 19,
            'MaxMind\\Exception\\' => 18,
            'MaxMind\\Db\\' => 11,
        ),
        'G' => 
        array (
            'GeoIp2\\' => 7,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MaxMind\\WebService\\' => 
        array (
            0 => __DIR__ . '/..' . '/maxmind/web-service-common/src/WebService',
        ),
        'MaxMind\\Exception\\' => 
        array (
            0 => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception',
        ),
        'MaxMind\\Db\\' => 
        array (
            0 => __DIR__ . '/..' . '/maxmind-db/reader/src/MaxMind/Db',
        ),
        'GeoIp2\\' => 
        array (
            0 => __DIR__ . '/..' . '/geoip2/geoip2/src',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\CaBundle\\CaBundle' => __DIR__ . '/..' . '/composer/ca-bundle/src/CaBundle.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'GeoIp2\\Database\\Reader' => __DIR__ . '/..' . '/geoip2/geoip2/src/Database/Reader.php',
        'GeoIp2\\Exception\\AddressNotFoundException' => __DIR__ . '/..' . '/geoip2/geoip2/src/Exception/AddressNotFoundException.php',
        'GeoIp2\\Exception\\AuthenticationException' => __DIR__ . '/..' . '/geoip2/geoip2/src/Exception/AuthenticationException.php',
        'GeoIp2\\Exception\\GeoIp2Exception' => __DIR__ . '/..' . '/geoip2/geoip2/src/Exception/GeoIp2Exception.php',
        'GeoIp2\\Exception\\HttpException' => __DIR__ . '/..' . '/geoip2/geoip2/src/Exception/HttpException.php',
        'GeoIp2\\Exception\\InvalidRequestException' => __DIR__ . '/..' . '/geoip2/geoip2/src/Exception/InvalidRequestException.php',
        'GeoIp2\\Exception\\OutOfQueriesException' => __DIR__ . '/..' . '/geoip2/geoip2/src/Exception/OutOfQueriesException.php',
        'GeoIp2\\Model\\AbstractModel' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/AbstractModel.php',
        'GeoIp2\\Model\\AnonymousIp' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/AnonymousIp.php',
        'GeoIp2\\Model\\Asn' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/Asn.php',
        'GeoIp2\\Model\\City' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/City.php',
        'GeoIp2\\Model\\ConnectionType' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/ConnectionType.php',
        'GeoIp2\\Model\\Country' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/Country.php',
        'GeoIp2\\Model\\Domain' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/Domain.php',
        'GeoIp2\\Model\\Enterprise' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/Enterprise.php',
        'GeoIp2\\Model\\Insights' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/Insights.php',
        'GeoIp2\\Model\\Isp' => __DIR__ . '/..' . '/geoip2/geoip2/src/Model/Isp.php',
        'GeoIp2\\ProviderInterface' => __DIR__ . '/..' . '/geoip2/geoip2/src/ProviderInterface.php',
        'GeoIp2\\Record\\AbstractPlaceRecord' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/AbstractPlaceRecord.php',
        'GeoIp2\\Record\\AbstractRecord' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/AbstractRecord.php',
        'GeoIp2\\Record\\City' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/City.php',
        'GeoIp2\\Record\\Continent' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/Continent.php',
        'GeoIp2\\Record\\Country' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/Country.php',
        'GeoIp2\\Record\\Location' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/Location.php',
        'GeoIp2\\Record\\MaxMind' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/MaxMind.php',
        'GeoIp2\\Record\\Postal' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/Postal.php',
        'GeoIp2\\Record\\RepresentedCountry' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/RepresentedCountry.php',
        'GeoIp2\\Record\\Subdivision' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/Subdivision.php',
        'GeoIp2\\Record\\Traits' => __DIR__ . '/..' . '/geoip2/geoip2/src/Record/Traits.php',
        'GeoIp2\\Util' => __DIR__ . '/..' . '/geoip2/geoip2/src/Util.php',
        'GeoIp2\\WebService\\Client' => __DIR__ . '/..' . '/geoip2/geoip2/src/WebService/Client.php',
        'MaxMind\\Db\\Reader' => __DIR__ . '/..' . '/maxmind-db/reader/src/MaxMind/Db/Reader.php',
        'MaxMind\\Db\\Reader\\Decoder' => __DIR__ . '/..' . '/maxmind-db/reader/src/MaxMind/Db/Reader/Decoder.php',
        'MaxMind\\Db\\Reader\\InvalidDatabaseException' => __DIR__ . '/..' . '/maxmind-db/reader/src/MaxMind/Db/Reader/InvalidDatabaseException.php',
        'MaxMind\\Db\\Reader\\Metadata' => __DIR__ . '/..' . '/maxmind-db/reader/src/MaxMind/Db/Reader/Metadata.php',
        'MaxMind\\Db\\Reader\\Util' => __DIR__ . '/..' . '/maxmind-db/reader/src/MaxMind/Db/Reader/Util.php',
        'MaxMind\\Exception\\AuthenticationException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/AuthenticationException.php',
        'MaxMind\\Exception\\HttpException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/HttpException.php',
        'MaxMind\\Exception\\InsufficientFundsException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/InsufficientFundsException.php',
        'MaxMind\\Exception\\InvalidInputException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/InvalidInputException.php',
        'MaxMind\\Exception\\InvalidRequestException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/InvalidRequestException.php',
        'MaxMind\\Exception\\IpAddressNotFoundException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/IpAddressNotFoundException.php',
        'MaxMind\\Exception\\PermissionRequiredException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/PermissionRequiredException.php',
        'MaxMind\\Exception\\WebServiceException' => __DIR__ . '/..' . '/maxmind/web-service-common/src/Exception/WebServiceException.php',
        'MaxMind\\WebService\\Client' => __DIR__ . '/..' . '/maxmind/web-service-common/src/WebService/Client.php',
        'MaxMind\\WebService\\Http\\CurlRequest' => __DIR__ . '/..' . '/maxmind/web-service-common/src/WebService/Http/CurlRequest.php',
        'MaxMind\\WebService\\Http\\Request' => __DIR__ . '/..' . '/maxmind/web-service-common/src/WebService/Http/Request.php',
        'MaxMind\\WebService\\Http\\RequestFactory' => __DIR__ . '/..' . '/maxmind/web-service-common/src/WebService/Http/RequestFactory.php',
        'NGIP_Admin_Module' => __DIR__ . '/../..' . '/core/interfaces/interface-ngip-admin-module.php',
        'NGIP_Admin_Settings' => __DIR__ . '/../..' . '/includes/modules/admins/class-ngip-admin-settings.php',
        'NGIP_Admins' => __DIR__ . '/../..' . '/includes/modules/class-ngip-admins.php',
        'NGIP_Callback_Exception' => __DIR__ . '/../..' . '/core/exceptions/class-ngip-callback-exception.php',
        'NGIP_EJS_Queue' => __DIR__ . '/../..' . '/core/etc/class-ngip-ejs-queue.php',
        'NGIP_Hook_Impl' => __DIR__ . '/../..' . '/core/traits/trait-ngip-hook-impl.php',
        'NGIP_Main' => __DIR__ . '/../..' . '/includes/class-ngip-main.php',
        'NGIP_Main_Base' => __DIR__ . '/../..' . '/core/abstracts/abstract-ngip-main-base.php',
        'NGIP_Module' => __DIR__ . '/../..' . '/core/interfaces/interface-ngip-module.php',
        'NGIP_Query_IP' => __DIR__ . '/../..' . '/includes/modules/class-ngip-query-ip.php',
        'NGIP_Reg' => __DIR__ . '/../..' . '/core/interfaces/interface-ngip-reg.php',
        'NGIP_Reg_Activation' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-activation.php',
        'NGIP_Reg_Ajax' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-ajax.php',
        'NGIP_Reg_Cron' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-cron.php',
        'NGIP_Reg_Cron_Schedule' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-cron-schedule.php',
        'NGIP_Reg_Deactivation' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-dectivation.php',
        'NGIP_Reg_Meta' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-meta.php',
        'NGIP_Reg_Option' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-option.php',
        'NGIP_Reg_Post_Type' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-post-type.php',
        'NGIP_Reg_Script' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-script.php',
        'NGIP_Reg_Shortcode' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-shortcode.php',
        'NGIP_Reg_Style' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-style.php',
        'NGIP_Reg_Submit' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-submit.php',
        'NGIP_Reg_Taxonomy' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-taxonomy.php',
        'NGIP_Reg_Uninstall' => __DIR__ . '/../..' . '/core/regs/class-ngip-reg-uninstall.php',
        'NGIP_Register' => __DIR__ . '/../..' . '/core/interfaces/interface-ngip-register.php',
        'NGIP_Register_Ajax' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-ajax.php',
        'NGIP_Register_Base_Activation' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-activation.php',
        'NGIP_Register_Base_Ajax' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-ajax.php',
        'NGIP_Register_Base_Cron' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-cron.php',
        'NGIP_Register_Base_Cron_Schedule' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-cron-schedule.php',
        'NGIP_Register_Base_Deactivation' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-deactivation.php',
        'NGIP_Register_Base_Option' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-option.php',
        'NGIP_Register_Base_Post_Type' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-post-type.php',
        'NGIP_Register_Base_Script' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-script.php',
        'NGIP_Register_Base_Style' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-style.php',
        'NGIP_Register_Base_Submit' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-submit.php',
        'NGIP_Register_Base_Taxonomy' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-taxonomy.php',
        'NGIP_Register_Base_Uninstall' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-uninstall.php',
        'NGIP_Register_Cron' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-cron.php',
        'NGIP_Register_Cron_Schedule' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-cron-schedule.php',
        'NGIP_Register_Option' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-option.php',
        'NGIP_Register_Script' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-script.php',
        'NGIP_Register_Style' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-style.php',
        'NGIP_Register_Uninstall' => __DIR__ . '/../..' . '/includes/registers/class-ngip-register-uninstall.php',
        'NGIP_Registers' => __DIR__ . '/../..' . '/includes/modules/class-ngip-registers.php',
        'NGIP_Reigster_Base_Meta' => __DIR__ . '/../..' . '/core/abstracts/registers/abstract-ngip-register-base-meta.php',
        'NGIP_Sciprt_Enqueue' => __DIR__ . '/../..' . '/core/etc/class-ngip-script-enqueue.php',
        'NGIP_Settings' => __DIR__ . '/../..' . '/includes/modules/class-ngip-settings.php',
        'NGIP_Submodule_Impl' => __DIR__ . '/../..' . '/core/traits/trait-ngip-submodule-impl.php',
        'NGIP_Template_Impl' => __DIR__ . '/../..' . '/core/traits/trait-ngip-template-impl.php',
        'NGIP_Updater' => __DIR__ . '/../..' . '/includes/modules/class-ngip-updater.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1fc226ac333637e08afbf14b104abf77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1fc226ac333637e08afbf14b104abf77::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1fc226ac333637e08afbf14b104abf77::$classMap;

        }, null, ClassLoader::class);
    }
}
