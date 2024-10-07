<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }
    /**
     * show every listing
     *
     * @return void
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ')->fetchAll();
        loadview('listings/index', ['listings' => $listings]);
    }
    /**
     * create a new listing
     *
     * @return void
     */
    public function create()
    {
        loadView('listings/create');
    }
    /** 
     * show a single listing
     * @param array $prams
     */
    public function show($prams)
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
        $id = $prams['id'] ?? "";
        $prams = [
            'id' => $id,
        ];
        $listings = $this->db->query('SELECT * FROM listings WHERE id = :id', $prams)->fetch();
        // check whether the listing exists
        if (!$listings) {
            ErrorController::notfound('Listing not found');
            return;
        }
        loadview('listings/show', ['listings' => $listings]);
    }
    /**
     * insert a new listing into the database
     *
     * @return void
     */
    public function store()
    {
        $allowedFeilds = ['title', 'description', 'salary', 'tags', 'company', 'city', 'country', 'phone', 'email', 'requierments', 'benifits'];
        $newListingsData = array_intersect_key($_POST, array_flip($allowedFeilds));
        $newListingsData['user_id'] = 1;

        $newListingsData = array_map('sanitize', $newListingsData);  // loop through the array and convert the strigs to keys
        $errors = [];
        $requieredFelids = ['title', 'description', 'email', 'city', 'country'];
        foreach ($requieredFelids as $feild) {
            if (empty($newListingsData[$feild]) || !Validation::string($newListingsData[$feild])) {
                $errors[$feild] = ucfirst($feild) . ' is required';
            }
        }
        if (!empty($errors)) {
            loadView('listings/create', ['errors' => $errors, 'listings' => $newListingsData]);
        } else {
            $feilds = [];
            foreach ($newListingsData as $feild => $value) {
                $feilds[] = $feild;
            }
            $feilds = implode(', ', $feilds);

            $values = [];
            foreach ($newListingsData as $feild => $value) {
                if ($value === '') {
                    $newListingsData[$feild] = null;
                }
                $values[] = ':' . $feild;
            }
            $values = implode(', ', $values);
            $query = "INSERT INTO listings ({$feilds}) VALUES ({$values})";
            $this->db->query($query, $newListingsData);
            redirect('/listings');
        }
    }
    /**
     * Destroy a listing
     * @param array $params
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];
        //inspectDie($params);
        $prams = ['id' => $id];
        $listings = $this->db->query('SELECT * FROM listings WHERE id = :id', $prams)->fetch();
        if (!$listings) {
            ErrorController::notfound('Listing not found');
            return;
        } else {
            $this->db->query('DELETE FROM listings WHERE id = :id', $prams);
            $_SESSION['success_message'] = 'Listing deleted successfully';
            redirect('/listings');
        }
    }

    /** 
     * show edit form of the listing
     * @param array $prams
     */
    public function edit($prams)
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
        $id = $prams['id'] ?? "";
        $prams = [
            'id' => $id,
        ];
        $listings = $this->db->query('SELECT * FROM listings WHERE id = :id', $prams)->fetch();
        // check whether the listing exists
        if (!$listings) {
            ErrorController::notfound('Listing not found');
            return;
        } else {
            loadview('listings/edit', ['listings' => $listings]);
        }
    }
    /**
     * update a listing
     * @param array $prams
     * @return void
     */
    public function update($prams)
    {
        $id = $prams['id'] ?? "";
        $prams = [
            'id' => $id,
        ];
        $listings = $this->db->query('SELECT * FROM listings WHERE id = :id', $prams)->fetch();
        // check whether the listing exists
        if (!$listings) {
            ErrorController::notfound('Listing not found');
            return;
        }
        $allowedFeilds = ['title', 'description', 'salary', 'tags', 'company', 'city', 'country', 'phone', 'email', 'requierments', 'benifits'];
        $updateValues = [];
        $updateValues = array_intersect_key($_POST, array_flip($allowedFeilds));
        $updateValues = array_map('sanitize', $updateValues);
        $updateValues['id'] = $id;

        $requieredFelids = ['title', 'description', 'email', 'city', 'country'];
        $errors = [];
        // running validation 
        foreach ($requieredFelids as $feild) {
            if (empty($updateValues[$feild]) || !Validation::string($updateValues[$feild])) {
                $errors[$feild] = ucfirst($feild) . ' is required';
            }
        }
        // if missing print error
        if (!empty($errors)) {
            loadView('listings/edit', ['errors' => $errors, 'listings' => $listings]);
            exit;
        } else { //prepare statment
            $updateFeilds = [];
            foreach (array_keys($updateValues) as $feild) {
                $updateFeilds[] = "{$feild} = :{$feild}";
            }
            $updateFeilds = implode(', ', $updateFeilds);
            $updateQuery = "UPDATE listings SET $updateFeilds WHERE id = :id";

            $this->db->query($updateQuery, $updateValues);
            $_SESSION['success message'] = 'listing updated';

            redirect('/listing/' . $id);
        }
    }
}
