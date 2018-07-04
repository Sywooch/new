<?php
/**
 * File: AuthorRule.php
 * Email: becksonq@gmail.com
 * Date: 24.06.2018
 * Time: 22:09
 */

namespace common\rbac;


use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param int|string $user the user ID
     * @param \yii\rbac\Item $item the role or permission that this rule is associated width
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute( $user, $item, $params )
    {
        return isset( $params['post'] ) ? $params['post']->author_id == $user : false;
    }
}