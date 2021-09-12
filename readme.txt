LARAVEL STARTER
    Clone the repository
        git clone https://github.com/evaldas1994/FINAL-EXAM.git

    Switch to the repo folder
        cd final-exam

    Install all the dependencies using composer
        composer install

    Install packages
        composer require barryvdh/laravel-dompdf

    Copy the example env file and make the required configuration changes in the .env file
        cp .env.example .env

    Generate a new application key
        php artisan key:generate

    Generate a new JWT authentication secret key
        php artisan jwt:generate

    Run the database migrations (Set the database connection in .env before migrating)
        php artisan migrate

    Start the local development server
        php artisan serve
        (You can now access the server at http://localhost:8000)



Database seeding
    Run the database seeder
        php artisan db:seed



API Specification
    Authenticate
        -POST /api/registration (api/Authentication/RegistrationController@save)
            body: (json) [name(varchar(50)), surname(varchar(50)), password(varchar(50)), password_confirmation(varchar(50)), email(varchar(50))]
            response: (json) [success(bool), message(varchar(255)), data[id(int), name(varchar(50)), surname(varchar(50)), email(varchar(50))]]

        -POST /api/login (api/Authentication/LoginController@login)
            body:  (json) [email(varchar(50), password(varchar(50)]
            response: (json) [success(bool), message(varchar(255))]

    UserController
        -GET api/user (api/UserController@index)
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data(array of users objects)]

        -GET api/user/{id} (api/UserController@show)
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), surname(varchar(50)), email(varchar(50)), is_admin(bool)]]

        -PATCH api/user/{id} (api/UserController/update)
            body: (json) [name(varchar(50)), surname(varchar(50)), password(varchar(50)), password_confirmation(varchar(50)), email(varchar(50))]
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), surname(varchar(50)), email(varchar(50)), is_admin(bool)]]

        -DELETE api/user/{id} (api/UserController/delete)
            response: (json) [success(bool), message(varchar(255))]

    RegionController
        -GET api/region (api/RegionController@index)
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data(array of regions objects)]

        -GET api/region/{id} (api/RegionController@show)
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50))]]

    LakeController
        -GET api/lake (api/LakeController@index)
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data(array of regions objects)]

        -GET api/lake/{id} (api/LakeController@show)
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), region_id(int)]]

        -POST api/lake (api/LakeController@store)
            body: (json) [name(varchar(50)), region_id(int)]
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), region_id(int)]]

        -PATCH api/lake/{id} (api/LakeController@update)
            body: (json) [name(varchar(50)), region_id(int)]
            response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), region_id(int)]]

        -DELETE api/lake/{id} (api/LakeController@delete)
            response: (json) [success(bool), message(varchar(255))]

    TicketController
            -GET api/ticket (api/TicketController@index)
                response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data(array of tickets objects)]

            -GET api/ticket/{id} (api/TicketController@show)
                response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), userName(varchar(50)), email(varchar), serial_number(int(9)), valid_from(timestamp), valid_to(timestamp), price(double), rods(int(10), created_at(timestamp), updated_at(timestamp)) ]]

            -POST api/ticket (api/TicketController@store)
                body: (json) [name(varchar(50)), surname(varchar(50)), email(varchar(50), valid_from(timestamp), valid_to(timestamp), rods(int(10)), lakes(Objects of Lake model))]
                response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), userName(varchar(50)), email(varchar), serial_number(int(9)), valid_from(timestamp), valid_to(timestamp), price(double), rods(int(10), created_at(timestamp), updated_at(timestamp)) ]]

            -PATCH api/ticket/{id} (api/TicketController@update)
                body: (json) [name(varchar(50)), surname(varchar(50)), email(varchar(50), valid_from(timestamp), valid_to(timestamp), rods(int(10)), lakes(Objects of Lake model))]
                response: (json) [success(bool), message(varchar(255)), (IF SUCCESS === TRUE) -> data[id(int), name(varchar(50)), userName(varchar(50)), email(varchar), serial_number(int(9)), valid_from(timestamp), valid_to(timestamp), price(double), rods(int(10), created_at(timestamp), updated_at(timestamp)) ]]

            -DELETE api/ticket/{id} (api/TicketController@delete)
                response: (json) [success(bool), message(varchar(255))]


Relations
    User->tickets :HasMany

    Region->lakes :HasMany

    Lake->region :BelongsTo
    Lake->tickets :BelongsToMany

    Ticket->user :BelongsTo
    Ticket->lakes :BelongsToMany
