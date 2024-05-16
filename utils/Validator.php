<?php

class Validator
{
    private $errors = [];

    public function sanitizeString($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }

    public function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isValidPassword($password)
    {
        // Altere essas regras conforme necessário para atender aos requisitos de senha do seu projeto
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        return $uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8;
    }

    public function validate($input, $rules)
    {
        foreach ($rules as $field => $ruleSet) {
            if (isset($input[$field])) {
                $value = $input[$field];
                $ruleSet = explode('|', $ruleSet);

                foreach ($ruleSet as $rule) {
                    if ($rule === 'required' && empty($value)) {
                        $this->errors[$field] = "{$field} é obrigatório";
                    }
                    if ($rule === 'email' && !$this->isValidEmail($value)) {
                        $this->errors[$field] = "{$field} não é um email válido";
                    }
                    // Adicionando a regra de tamanho de string
                    if (substr($rule, 0, 6) === 'length') {
                        $length = (int)substr($rule, 7, -1);
                        if (strlen($value) !== $length) {
                            $this->errors[$field] = "{$field} deve ter exatamente {$length} caracteres";
                        }
                    }
                    // Adicionando a regra de intervalo mínimo e máximo de números
                    if (substr($rule, 0, 6) === 'range') {
                        $range = explode(',', substr($rule, 7, -1));
                        $min = (int)$range[0];
                        $max = (int)$range[1];

                        if (!is_numeric($value) || $value < $min || $value > $max) {
                            $this->errors[$field] = "{$field} deve estar no intervalo entre {$min} e {$max}";
                        }
                    }
                }
            }
        }
    }

    public function fails()
    {
        return !empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
