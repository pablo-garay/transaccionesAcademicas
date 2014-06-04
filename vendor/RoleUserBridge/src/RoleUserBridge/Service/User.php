<?php

namespace RoleUserBridge\Service;

use RoleUserBridge\Mapper\RoleInterface;

use RoleUserBridge\Mapper\RoleMapper;

use ZfcUser\Service\User as ZfcUser;

class User extends ZfcUser
{

    protected $roleMapper;

    public function setRoleMapper(RoleInterface $roleMapper)
    {
        $this->roleMapper = $roleMapper;
        return $this;
    }

    public function getRoleMapper()
    {
        if (null === $this->roleMapper) {
            $this->roleMapper = $this->getServiceManager()->get('user_role_mapper');
        }
        return $this->roleMapper;

    }

    public function register(array $data)
    {
        $registerresult = parent::register($data);

        if($registerresult !== false) {
            $user = parent::getUserMapper()->findByEmail($registerresult->getEmail());
            $userRole = array(
                    'user_id' => $user->getId(),
                    'role_id' => 'user'
                    );
            $this->getRoleMapper()->insert($userRole);
            return $user;
        }
        return $registerresult;
    }

    public function remove(array $data){
        if($data['role_id']!==''){
            $where = 'user_id =' . $data['user_id'] . ' && role_id=' . $data['role_id'];
        }else{
            $where = 'user_id = ' . $data['user_id'];
        }

        return $this->getRoleMapper()->delete($data, $where);
    }

    public function update(array $data){
        $where = 'user_id =' . $data['user_id'];
        return $this->getRoleMapper()->update($data, $where);
    }

}
