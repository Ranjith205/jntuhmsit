<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['api']['Common__Authenticate User'] = array(
    'url' => 'services/userAuth',
    'method' => 'post',
    'post' => array(
        'username' => '',
        'password' => '',
        'gcm_id' => ''
    ),
    'notes' => 'This url is for User Authentication.',
    'input_parameters' => array(
        'username' => 'User name of regisgered User, Required',
        'password' => 'password of the registered,Rrequired',
        'gum_id' => 'gcm_id requried for notification'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Common__Change Password'] = array(
    'url' => 'services/change_password/',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'password' => '',
        'old_password' => ''
    ),
    'notes' => 'This url is for changing the password.',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'password' => 'Password is required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

//$config['api']['Common__Forgot Password'] = array(
//    'url' => 'services/forgot_password/',
//    'method' => 'post',
//    'post' => array(
//  'username' => '',
//  'is_app_view_test' => ''
//    ),
//    'notes' => 'This url is for forgot the password.',
//    'input_parameters' => array(
//  'username' => 'username is Required',
//  'is_app_view_test' => '1 or 0'
//    ),
//    'output_responses' => array(
//  'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
//  'failure' => "Displays the error messages"
//    )
//);
//
$config['api']['Common__Update User Profile'] = array(
    'url' => 'services/update_user_profile/',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'full_name' => '',
        'mobile' => '',
        'email' => '',
        'user_img' => ''
    ),
    'notes' => 'This url is for updating the users profile.',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'full_name' => 'Name is required',
        'mobile' => 'Contact number is required',
        'email' => 'email address is requried'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get Courses'] = array(
    'url' => 'services/get_courses',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is for getting the courses .',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get Marks'] = array(
    'url' => 'services/get_marks',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'cid' => ''
    ),
    'notes' => 'This url is for getting the courses .',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'cid' => 'course id is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get Mentors Details'] = array(
    'url' => 'services/get_mentors_details',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is for getting the Mentor Details .',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get Events'] = array(
    'url' => 'services/get_events',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'event_date' => ''
    ),
    'notes' => 'This url is for getting the Event Details .',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get Students'] = array(
    'url' => 'services/get_student_data',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is for getting the Students Details .',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Apply Leave'] = array(
    'url' => 'services/apply_leave',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'reason' => '',
        'from_date' => '',
        'to_date' => ''
    ),
    'notes' => 'This url is for applying leave',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'reason' => '',
        'from_date' => '',
        'to_date' => ''
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Leave history'] = array(
    'url' => 'services/get_leave_history',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is for applying leave',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get Student Attendance'] = array(
    'url' => 'services/get_student_attendance',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is for applying leave',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Student__Get My Teams'] = array(
    'url' => 'services/get_my_team',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'cid' => ''
    ),
    'notes' => 'This url is for applying leave',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'cid' => 'course id is requeired '
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Mentor__Get Student By Course'] = array(
    'url' => 'services/get_student_by_course',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'cid' => ''
    ),
    'notes' => 'This url is for getting the Event Details .',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Mentor__Post Event'] = array(
    'url' => 'services/post_event',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'title' => '',
        'desc' => '',
        'event_date' => ''
    ),
    'notes' => 'This url is for getting the Event Details .',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Mentor__Get Student Marks'] = array(
    'url' => 'services/get_marks_by_student',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'student_id' => ''
    ),
    'notes' => 'This url is for getting the Student Marks Details .',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'student_id' => 'student_id is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Mentor__Get Student by Present Course'] = array(
    'url' => 'services/get_students_by_present_course',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is for getting the Student enrolled by the mentor in a course',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);


$config['api']['Mentor__Post Attendance'] = array(
    'url' => 'services/post_attendance',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'date'=>'',
        'attendance'=> ''
    ),
    'notes' => 'This url is to note the attendance of the students',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Mentor__Leave Approv'] = array(
    'url' => 'services/leave_approve',
    'method' => 'post',
    'post' => array(
        'guid' => '',
        'approve_status'=>'',
        'lid'=> ''
    ),
    'notes' => 'This url is to note the attendance of the students',
    'input_parameters' => array(
        'guid' => 'GUID is Required',
        'approved status'=> ' approved id should be given',
        'lid' => 'leave id'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);

$config['api']['Mentor__Get Leave Applied'] = array(
    'url' => 'services/leaves_applied',
    'method' => 'post',
    'post' => array(
        'guid' => ''
    ),
    'notes' => 'This url is to note the attendance of the students',
    'input_parameters' => array(
        'guid' => 'GUID is Required'
    ),
    'output_responses' => array(
        'success' => "Returns \"Success Message\" and Data in Json format (For required services)",
        'failure' => "Displays the error messages"
    )
);