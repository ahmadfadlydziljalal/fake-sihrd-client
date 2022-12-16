<?php

use yii\db\Migration;

/**
 * Class m221216_044715_initMdmPackages
 */
class m221216_044715_initMdmPackages extends Migration
{
   /**
    * {@inheritdoc}
    */
   public function safeUp()
   {
      $this->execute("set foreign_key_checks = 0");
      $sql = <<<SQL
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('super-admin', '1', 1671166304);

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/assignment/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/assignment/assign', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/assignment/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/assignment/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/default/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/default/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/menu/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/menu/create', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/menu/delete', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/menu/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/menu/update', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/menu/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/assign', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/create', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/delete', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/get-users', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/remove', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/update', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/permission/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/assign', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/create', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/delete', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/get-users', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/remove', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/update', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/role/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/route/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/route/assign', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/route/create', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/route/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/route/refresh', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/route/remove', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/rule/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/rule/create', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/rule/delete', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/rule/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/rule/update', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/rule/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/activate', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/change-password', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/delete', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/login', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/logout', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/reset-password', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/signup', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/admin/user/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/default/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/default/db-explain', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/default/download-mail', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/default/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/default/toolbar', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/default/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/user/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/debug/user/set-identity', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/default/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/default/action', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/default/diff', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/default/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/default/preview', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/gii/default/view', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/*', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/authorize', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/captcha', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/error', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/index', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/login', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('/site/logout', 2, NULL, NULL, NULL, 1671166290, 1671166290),
	('super-admin', 1, NULL, NULL, NULL, 1671166297, 1671166297);

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('super-admin', '/*');




SQL;
      $this->execute($sql);
      $this->insert('user', [
         'id' => 1,
         'username' => 'Admin',
         'auth_key' => 'HydDPYvB6Xh0YvqDVioz1uTr_D5lEqDv',
         'password_hash' => '$2y$13$mpIMUslw.ZSUkWNZvY9dxOWFbsdycJyicob80o2bJ3MvgokhoEvtO',
         'password_reset_token' => NULL,
         'email' => 'email@email.com',
         'status' => 10,
         'created_at' => 1671166283,
         'updated_at' => 1671166283,
      ]);
      $this->execute("set foreign_key_checks = 1");

   }

   /**
    * {@inheritdoc}
    */
   public function safeDown()
   {

   }

   /*
   // Use up()/down() to run migration code without a transaction.
   public function up()
   {

   }

   public function down()
   {
       echo "m221216_044715_initMdmPackages cannot be reverted.\n";

       return false;
   }
   */
}