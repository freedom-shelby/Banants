<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'App' => $baseDir . '/system/App.php',
    'ArticleModel' => $baseDir . '/models/ArticleModel.php',
    'Back\\Articles' => $baseDir . '/controllers/Back/Articles.php',
    'Back\\Back' => $baseDir . '/controllers/Back.php',
    'Back\\Categories' => $baseDir . '/controllers/Back/Categories.php',
    'Back\\Entities' => $baseDir . '/controllers/Back/Entities.php',
    'Back\\Menus' => $baseDir . '/controllers/Back/Menus.php',
    'Back\\Pages' => $baseDir . '/controllers/Back/Pages.php',
    'Back\\Settings' => $baseDir . '/controllers/Back/Settings.php',
    'Base' => $baseDir . '/controllers/Base.php',
    'BaumTestCase' => $baseDir . '/controllers/Test/NestedSets/suite/BaumTestCase.php',
    'Cache\\LocalStorage' => $baseDir . '/system/Cache/LocalStorage.php',
    'Category' => $baseDir . '/controllers/Test/NestedSets/models/Category.php',
    'CategoryColumnsTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryColumnsTest.php',
    'CategoryCustomEventsTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryCustomEventsTest.php',
    'CategoryHierarchyTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryHierarchyTest.php',
    'CategoryMigrator' => $baseDir . '/controllers/Test/NestedSets/migrators/CategoryMigrator.php',
    'CategoryMovementTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryMovementTest.php',
    'CategoryRelationsTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryRelationsTest.php',
    'CategoryScopedTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryScopedTest.php',
    'CategorySeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/CategorySeeder.php',
    'CategorySoftDeletesTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategorySoftDeletesTest.php',
    'CategoryTestCase' => $baseDir . '/controllers/Test/NestedSets/suite/CategoryTestCase.php',
    'CategoryTreeMapperTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryTreeMapperTest.php',
    'CategoryTreeRebuildingTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryTreeRebuildingTest.php',
    'CategoryTreeValidationTest' => $baseDir . '/controllers/Test/NestedSets/suite/Category/CategoryTreeValidationTest.php',
    'Cluster' => $baseDir . '/controllers/Test/NestedSets/models/Cluster.php',
    'ClusterColumnsTest' => $baseDir . '/controllers/Test/NestedSets/suite/Cluster/ClusterColumnsTest.php',
    'ClusterHierarchyTest' => $baseDir . '/controllers/Test/NestedSets/suite/Cluster/ClusterHierarchyTest.php',
    'ClusterMigrator' => $baseDir . '/controllers/Test/NestedSets/migrators/ClusterMigrator.php',
    'ClusterMovementTest' => $baseDir . '/controllers/Test/NestedSets/suite/Cluster/ClusterMovementTest.php',
    'ClusterSeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/ClusterSeeder.php',
    'ClusterTestCase' => $baseDir . '/controllers/Test/NestedSets/suite/ClusterTestCase.php',
    'ContentModel' => $baseDir . '/models/ContentModel.php',
    'Controller' => $baseDir . '/system/Controller.php',
    'Crypt' => $baseDir . '/system/Crypt.php',
    'Crypt\\Caesar' => $baseDir . '/system/Crypt/Caesar.php',
    'Crypt\\DoubleSqr' => $baseDir . '/system/Crypt/DoubleSqr.php',
    'Crypt\\Rijndael' => $baseDir . '/system/Crypt/Rijndael.php',
    'Crypt\\Sha256' => $baseDir . '/system/Crypt/Sha256.php',
    'EntityModel' => $baseDir . '/models/EntityModel.php',
    'EntityTranslationModel' => $baseDir . '/models/EntityTranslationModel.php',
    'Event' => $baseDir . '/system/Event.php',
    'Event\\Emmiter' => $baseDir . '/system/Event/Emmiter.php',
    'Event\\EventHandlerInterface' => $baseDir . '/system/Event/EventHandlerInterface.php',
    'Front\\Front' => $baseDir . '/controllers/Front.php',
    'Front\\Pages' => $baseDir . '/controllers/Front/Pages.php',
    'GalleryModel' => $baseDir . '/models/GalleryModel.php',
    'HTML' => $baseDir . '/app/HTML.php',
    'Helpers\\Arr' => $baseDir . '/system/Helpers/Arr.php',
    'Helpers\\Date' => $baseDir . '/system/Helpers/Date.php',
    'Helpers\\Uri' => $baseDir . '/system/Helpers/Uri.php',
    'Http' => $baseDir . '/system/Http.php',
    'Http\\Exception' => $baseDir . '/system/Http/Exception.php',
    'LangModel' => $baseDir . '/models/LangModel.php',
    'Lang\\I18n' => $baseDir . '/app/Lang/I18n.php',
    'Lang\\Lang' => $baseDir . '/app/Lang/Lang.php',
    'MenuItemModel' => $baseDir . '/models/MenuItemModel.php',
    'MenuModel' => $baseDir . '/models/MenuModel.php',
    'Message' => $baseDir . '/system/Message.php',
    'MultiScopedCategory' => $baseDir . '/controllers/Test/NestedSets/models/Category.php',
    'MultiScopedCategorySeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/CategorySeeder.php',
    'MultiScopedCluster' => $baseDir . '/controllers/Test/NestedSets/models/Cluster.php',
    'Node' => $baseDir . '/system/Node.php',
    'NodeModelExtensionsTest' => $baseDir . '/controllers/Test/NestedSets/suite/NodeModelExtensionsTest.php',
    'OrderedCategory' => $baseDir . '/controllers/Test/NestedSets/models/Category.php',
    'OrderedCategorySeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/CategorySeeder.php',
    'OrderedCluster' => $baseDir . '/controllers/Test/NestedSets/models/Cluster.php',
    'OrderedClusterSeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/ClusterSeeder.php',
    'OrderedScopedCategory' => $baseDir . '/controllers/Test/NestedSets/models/Category.php',
    'OrderedScopedCategorySeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/CategorySeeder.php',
    'Page' => $baseDir . '/app/Page.php',
    'QueryBuilderExtensionTest' => $baseDir . '/controllers/Test/NestedSets/suite/QueryBuilderExtensionTest.php',
    'Route' => $baseDir . '/system/Route.php',
    'Router' => $baseDir . '/system/Router.php',
    'ScopedCategory' => $baseDir . '/controllers/Test/NestedSets/models/Category.php',
    'ScopedCategorySeeder' => $baseDir . '/controllers/Test/NestedSets/seeders/CategorySeeder.php',
    'ScopedCluster' => $baseDir . '/controllers/Test/NestedSets/models/Cluster.php',
    'Setting' => $baseDir . '/app/Setting.php',
    'SettingsModel' => $baseDir . '/models/SettingsModel.php',
    'SoftCategory' => $baseDir . '/controllers/Test/NestedSets/models/Category.php',
    'SoftCluster' => $baseDir . '/controllers/Test/NestedSets/models/Cluster.php',
    'Subscribers\\Route\\GlobalEventHandler' => $baseDir . '/app/Subscribers/Route/GlobalEventHandler.php',
    'Test\\FakerTest' => $baseDir . '/controllers/Test/FakerTest.php',
    'Test\\I18nTest' => $baseDir . '/controllers/Test/I18nTest.php',
    'Test\\NestedSets' => $baseDir . '/controllers/Test/NestedSets.php',
    'Test\\RouteTests' => $baseDir . '/controllers/Test/RouteTests.php',
    'Test\\ViewTests' => $baseDir . '/controllers/Test/ViewTests.php',
    'Test\\Widget' => $baseDir . '/controllers/Test/Widget.php',
    'Test\\WordTranslate' => $baseDir . '/controllers/Test/WordTranslate.php',
    'Theme' => $baseDir . '/app/Theme.php',
    'View' => $baseDir . '/system/View.php',
    'WidgetModel' => $baseDir . '/models/WidgetModel.php',
    'Widgets\\AbstractWidget' => $baseDir . '/app/Widgets/AbstractWidget.php',
    'Widgets\\Widget\\Banner' => $baseDir . '/app/Widgets/Widget/Banner.php',
    'Widgets\\Widget\\BestPlayer' => $baseDir . '/app/Widgets/Widget/BestPlayer.php',
    'Widgets\\Widget\\InfoBlog' => $baseDir . '/app/Widgets/Widget/InfoBlog.php',
    'Widgets\\Widget\\PhotoGalleries' => $baseDir . '/app/Widgets/Widget/PhotoGalleries.php',
    'Widgets\\Widget\\Snipers' => $baseDir . '/app/Widgets/Widget/Snipers.php',
    'Widgets\\Widget\\TournamentTable' => $baseDir . '/app/Widgets/Widget/TournamentTable.php',
    'Widgets\\WidgetsContainer' => $baseDir . '/app/Widgets/WidgetsContainer.php',
);
