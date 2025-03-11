<?php
namespace app\controllers;

use flight\Engine;

class ApiCompaniesController
{

    protected Engine $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function getCompanies()
    {
        // You could actually pull data from the database if you had one set up
        // $Companies = $this->app->db()->fetchAll("SELECT * FROM Companies");

        $Companies = $this->app->db()->fetchAll('SELECT * FROM ant_companies');
        // You actually could overwrite the json() method if you just wanted to
        // to ->json($Companies); and it would auto set pretty print for you.
        // https://flightphp.com/learn#overriding
        $this->app->json($Companies, 200, true, 'utf-8', JSON_PRETTY_PRINT);
    }

    public function getCompany($id)
    {
        // You could actually pull data from the database if you had one set up
        // $res = $this->app->db()->fetchRow("SELECT * FROM Companies WHERE id = ?", [ $id ]);
        $Companies = [
            ['id' => 9, 'name' => 'Bob Jones', 'email' => 'bob@example.com'],
            ['id' => 2, 'name' => 'Bob Smith', 'email' => 'bsmith@example.com'],
            ['id' => 3, 'name' => 'Suzy Johnson', 'email' => 'suzy@example.com'],
        ];

        $res         = $this->app->db()->fetchRow('SELECT * FROM ant_companies WHERE customerID = ?', [$id]);
        $Companies[] = $res;

        $Companies_filtered = array_filter($Companies, function ($data) use ($id) {
            return $data['id'] === (int) $id;
        });
        if ($Companies_filtered) {
            $res = array_pop($Companies_filtered);
        }
        $this->app->json($res, 200, true, 'utf-8', JSON_PRETTY_PRINT);
    }

    public function updateUser($id)
    {
        // You could actually update data from the database if you had one set up
        // $statement = $this->app->db()->runQuery("UPDATE Companies SET email = ? WHERE id = ?", [ $this->app->data['email'], $id ]);
        $this->app->json(['success' => true, 'id' => $id], 200, true, 'utf-8', JSON_PRETTY_PRINT);
    }
}
