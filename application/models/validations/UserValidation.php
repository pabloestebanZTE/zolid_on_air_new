<?php
class UserValidation extends Validator {

    private $request;

    function __construct($request, $errorsKeys = null) {
        parent::__construct($errorsKeys);
        $this->request = $request;
        $this->init();
    }

    private function init() {
        $this->make(
                $this->request->all(), [
                /* Validaciones... */
                "N_NAME_USER" => "required",
                "N_LASTNAME_USER" => "required",
                "N_MAIL_USER" => "required|email",
                "N_PHONE_USER" => "required|min:20|max:40",
                "N_CELLPHONE_USER" => "required"
              ],
              [
                /* Mensajes... */
                "N_NAME_USER.required" => "El nombre es requerido.",
                "N_LASTNAME_USER.required" => "Apellidos requeridos.",
                "N_MAIL_USER.required" => "El correo es requerido.",
                "N_MAIL_USER.email" => "El correo es inválido.",
                "N_PHONE_USER.required" => "El teléfono es requerido.",
                "N_CELLPHONE_USER.required" => "El celular es requerido."
              ]
              );
    }

}
