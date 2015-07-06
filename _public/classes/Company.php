<?php

/**
 * Handles the Company Registration
 * @author Sirvan Almasi
 */
class Company
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var array collection of error messages
     */
    public  $errors                   = array();
    /**
     * @var bool success state of company upload
     */
    public  $newComp_successful     = false;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct($userid, $userActiveLevel, $company_type)
    {
        $this->userid = $userid;
        $this->company_type = $company_type;
        $this->userActiveLevel = $userActiveLevel;

        // if we have such a POST request, call the registerNewUser() method
        if (isset($_POST["new_company"])) {
          $this->newCompany(
            $_POST['company_name'],
            $_POST['company_number'],
            $_POST['revenue'],
            $_POST['industry'],
            $_POST['comp_type'],
            $_POST['contact_name'],
            $_POST['contact_tel'],
            $_POST['contact_adrs_1'],
            $_POST['contact_adrs_2'],
            $_POST['contact_adrs_3'],
            $_POST['postcode']
          );
        }
    }

    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {
                // Generate a database connection, using the PDO connector
                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
                // Also important: We include the charset, as leaving it out seems to be a security issue:
                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
                // "Adding the charset to the DSN is very important for security reasons,
                // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }

    /**
     *
     */
    private function newCompany($name, $number, $revenue, $industry, $type, $cName, $cTel, $cAddress1, $cAddress2, $cAddress3, $cPostcode)
    {
        if ($this->databaseConnection()) {
          $query_new_company = $this->db_connection->prepare('INSERT INTO company (name, reg_number, revenue, industry, company_size, contact_name, contact_tel, contact_address_1, contact_address_2, contact_address_3, contact_address_postcode, users_id, company_type) VALUES(:name, :reg_number, :revenue, :industry, :company_size, :contact_name, :contact_tel, :contact_address_1, :contact_address_2, :contact_address_3, :contact_address_postcode, :users_id, :company_type)');
          $query_new_company->bindValue(':name', $name, PDO::PARAM_STR);
          $query_new_company->bindValue(':reg_number', $number, PDO::PARAM_STR);
          $query_new_company->bindValue(':revenue', $revenue, PDO::PARAM_STR);
          $query_new_company->bindValue(':industry', $industry, PDO::PARAM_STR);
          $query_new_company->bindValue(':company_size', $type, PDO::PARAM_STR);
          $query_new_company->bindValue(':contact_name', $cName, PDO::PARAM_STR);
          $query_new_company->bindValue(':contact_tel', $cTel, PDO::PARAM_STR);
          $query_new_company->bindValue(':contact_address_1', $cAddress1, PDO::PARAM_STR);
          $query_new_company->bindValue(':contact_address_2', $cAddress2, PDO::PARAM_STR);
          $query_new_company->bindValue(':contact_address_3', $cAddress3, PDO::PARAM_STR);
          $query_new_company->bindValue(':contact_address_postcode', $cPostcode, PDO::PARAM_STR);
          $query_new_company->bindValue(':users_id', intval(trim($this->userid)), PDO::PARAM_INT);
          $query_new_company->bindValue(':company_type', intval(trim($this->company_type)), PDO::PARAM_INT);
          $query_new_company->execute();

          // We assume if comptype==1 then its a customer therefore user already active
          if ($this->company_type==2) {
            if ($this->userActiveLevel==2) {
              $userActiveLevel = 3;
            } else {
              $userActiveLevel = 1;
            }
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active_lvl = :userActiveLevel WHERE user_id = :user_id');
            $query_update_user->bindValue(':userActiveLevel', intval(trim($userActiveLevel)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_id', intval(trim($this->userid)), PDO::PARAM_INT);
            $query_update_user->execute();
          }
          $this->newComp_successful = true;
        }
    }

}
