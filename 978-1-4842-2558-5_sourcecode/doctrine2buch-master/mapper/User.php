<?php
namespace Mapper;

class User
{
    private $mapping = array(
        'id' => 'id',
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'gender' => 'gender',
        'namePrefix' => 'name_prefix'
    );

    public function getIdColumn()
    {
        return 'id';
    }

    public function extract($user)
    {
        $data = array();

        foreach ($this->mapping as $keyObject => $keyColumn) {
            if ($keyColumn != $this->getIdColumn()) {
                $data[$keyColumn] = call_user_func(
                    array($user, 'get'. ucfirst($keyObject))
                );
            }
        }

        return $data;
    }

    public function populate($data, $user)
    {
        $mappingsFlipped = array_flip($this->mapping);

        foreach ($data as $key => $value) {
            if (isset($mappingsFlipped[$key])) {
                call_user_func_array(
                    array($user, 'set'. ucfirst($mappingsFlipped[$key])),
                    array($value)
                );
            }
        }

        return $user;
    }
}
