<?php

namespace models;
use \PDO;

class Student
{
    protected $student_id;
    protected $first_name;
    protected $last_name;
    protected $birthdate;
    protected $address;
    protected $program;
    protected $contact_number;
    protected $emergencyContact;

    public function __construct($student_id, $first_name, $last_name, $birthdate, $address, $program, $contact_number, $emergency_contact)
    {
        $this->student_id = $student_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->$birthdate= $birthdate;
        $this->$address = $address;
        $this->email = $program;
        $this->contact_number = $contact_number;
        $this->emergency_contact = $emergency_contact;
    }
    public function getId()
	{
		return $this->student_id;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

    public function getAdress()
	{
		return $this->address;
	}

    public function getProgram()
	{
		return $this->program;
    }

    public function getContactNumber()
	{
		return $this->contact_number;
    }
    
    public function getEmergencyContact()
	{
		return $this->emergency_contact;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function saveStudent()
	{
		try {
			$sql = "INSERT INTO students SET first_name=:first_name, last_name=:last_name, birthdate=:birthdate, address=:address, program=:program, contact_number=:contact_number, emergency_contact=:emergency_contact";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':first_name' => $this->getFirstName(),
				':last_name' => $this->getLastName(),
                ':birthdate' => $this->getBirthdate(),
                ':address' => $this->getAddress(),
                ':program'=> $this->getProgram(),
                ':contact_number'=> $this->getContactNumber(),
                ':emergency_contact'=> $this->getEmergencyContact(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM students WHERE student_id=:student_id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':student_id' => $student_id
			]);

			$row = $statement->fetch();

			$this->id = $row['student_id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
			$this->birthdate = $row['birthdate'];
			$this->address = $row['address'];
            $this->program = $row['program'];
			$this->contact_number = $row['contact_number'];
			$this->emergency_contact = $row['emergency_contact'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}


    public function updateStudent($first_name, $last_name, $birthdate, $address, $program, $contact_number, $emergencyContact)
	{
		try {
			$sql = 'UPDATE students SET first_name=?, last_name=?, birthdate=?, address=?, program=?, contact_number=? WHERE student_id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
                $last_name,
				$address,
				$program,
				$contact_number,
				$program,
                $this->getId()

			]);
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function deleteStudent()
	{
		try {
			$sql = 'DELETE FROM students WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM students';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

	public function viewClasses($id){
        try {
            $sql = "SELECT * FROM students INNER JOIN class_rosters ON students.student_number=class_rosters.student_number INNER JOIN classes ON class_rosters.class_code=classes.class_code WHERE students.id=:id";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':id' => $id
            ]);
            return $statement->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}