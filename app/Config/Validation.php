<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $agents = [
        'fname' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'First Name field is required'
            ]
        ],
        'mname' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Middle Name field is required'
            ]
        ],
        'lname' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Last Name field is required'
            ]
        ],
        'contact' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Contact Number field is required'
            ]
        ],
        'email' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Email is field is required'
            ]
        ],
    ];

    public array $variants = [];

    public array $variants_spec = [
        'spec_cat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Please Select Category'
            ]
        ],
        'spec_type' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Please Select Specification'
            ]
        ],
        'vs_value' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Please input a value'
            ]
        ]
    ];

    public array $vehicle = [
        'title' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Please add a name for a vehicle'
            ]
        ],
        'tagline' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Please add tagline for this vehicle'
            ]
        ],
        'categories' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Please select atleast one category'
            ]
        ]
    ];
}
