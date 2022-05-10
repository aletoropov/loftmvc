<?php

namespace App\Model;

use Core\AbstractModel;
use Core\Db;

class User extends AbstractModel
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;

    private int $id;
    private string $name;
    private string $password;
    private int $gender;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     * @return User
     */
    public function setGender(int $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getGenderString(): string
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    public function save()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO users (`name`, `password`, `gender`) 
                   VALUES (:name, :password, :gender)";

        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':password' => $this->password,
            ':gender' => $this->getGender(),
        ]);

        $id = $db->lastInsertId();
        $this->setId($id);

        return $id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            return null;
        }

        $model = new self();
        $model->setId($data['id'])->setName($data['name'])->setGender($data['gender'])->setPassword($data['password']);
        return $model;
    }

    public static function getByName(string $name): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";

        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name,
        ]);

        if (!$data) {
            return null;
        }

        $model = new self();
        $model->setId($data['id'])->setName($data['name'])->setGender($data['gender'])->setPassword($data['password']);
        return $model;
    }

}
