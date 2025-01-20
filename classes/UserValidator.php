<?php
namespace Classes;


class UserValidator {
    
    public static function validateEmail($email) {
        if (empty($email)) {
            return 'Email is required.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email format.';
        }
        return null;
    }

    public static function validatePassword($password) {
        if (empty($password)) {
            return 'Password is required.';
        }
        if (strlen($password) < 8) {
            return 'Password must be at least 8 characters long.';
        }
        return null;
    }

    public static function validateNom($nom) {
        if (empty($nom)) {
            return 'Name is required.';
        }
        return null;
    }

    public static function validateRole($role) {
        $validRoles = ['admin', 'enseignant', 'etudiant']; 
        if (!in_array($role, $validRoles)) {
            return 'Invalid role.';
        }
        return null;
    }

    public static function validateUserData($email, $password, $nom, $role) {
        $errors = [];

        // Validation des champs
        $emailError = self::validateEmail($email);
        if ($emailError) $errors['email'] = $emailError;

        $passwordError = self::validatePassword($password);
        if ($passwordError) $errors['password'] = $passwordError;

        $nomError = self::validateNom($nom);
        if ($nomError) $errors['nom'] = $nomError;

        $roleError = self::validateRole($role);
        if ($roleError) $errors['role'] = $roleError;

        return $errors;
    }
}
