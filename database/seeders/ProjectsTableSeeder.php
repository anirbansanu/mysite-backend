<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'type' => json_encode(['web', 'script']),
                'img_path' => 'http://localhost:3000/images/reactProject.png',
                'title' => 'C19 Tracker',
                'badges' => json_encode(['ReactJS', 'SETU API\'s']),
                'project_link' => 'https://anirbansanu.github.io/c19-tracker/',
                'github_link' => 'https://github.com/anirbansanu/c19-tracker',
                'desc' => 'C19-tracker is COVID Tracking Project collects and publishes the most complete Active, Affected, Testing and Vaccinated data available for India states and territories.'
            ],
            [
                'type' => json_encode(['web', 'script']),
                'img_path' => 'http://localhost:3000/images/reactProject.png',
                'title' => 'Card Library',
                'badges' => json_encode(['html', 'css', 'javascript', 'React']),
                'project_link' => 'https://anirbansanu.github.io/card/',
                'github_link' => 'https://github.com/anirbansanu/card',
                'desc' => 'This is a library that allows your user to minimize, maximize and close your HTML elements. You can choose which of the previous interactions are allowed.'
            ],
            [
                'type' => json_encode(['web', 'script']),
                'img_path' => 'http://localhost:3000/images/reactProject.png',
                'title' => 'ToDo',
                'badges' => json_encode(['html', 'css', 'javascript', 'React']),
                'project_link' => 'https://anirbansanu.github.io/Todo/',
                'github_link' => 'https://github.com/anirbansanu/Todo',
                'desc' => 'use Todo when you have a deadline, NEED to focus, prioritize and get things done quickly from home or school projects, to dozens of work tasks with sub-tasks and projects.'
            ],
            [
                'type' => json_encode(['script']),
                'img_path' => 'http://localhost:3000/images/hacking.gif',
                'title' => 'Backdoor',
                'badges' => json_encode(['python', 'pycharm']),
                'project_link' => 'https://github.com/anirbansanu/Hacking',
                'github_link' => 'https://github.com/anirbansanu/Hacking',
                'desc' => 'C19-tracker is COVID Tracking Project collects and publishes the mo'
            ],
            [
                'type' => json_encode(['web']),
                'img_path' => 'http://localhost:3000/images/allinone.png',
                'title' => 'Btn-Eff',
                'badges' => json_encode(['css']),
                'project_link' => 'https://anitechtime.000webhostapp.com/css-libs/btn-eff/index.html',
                'github_link' => 'https://github.com/anirbansanu/btn-eff',
                'desc' => 'btn-eff is a collection of lightly-styled buttons that feature different shapes, sizes and colors. All styles can be called with simple class names. With the minified CSS file coming in at just 4kb, this library is also quite lightweight.'
            ],
            [
                'type' => json_encode(['web', 'script']),
                'img_path' => 'http://localhost:3000/images/htmlcssjsphp.png',
                'title' => 'LMail',
                'badges' => json_encode(['html', 'css', 'javascript', 'php', 'mariaDB']),
                'project_link' => 'https://anitechtime.000webhostapp.com/lock-mail/mail/user/log-in.php',
                'github_link' => 'https://anitechtime.000webhostapp.com/lock-mail/mail/user/log-in.php',
                'desc' => 'This is mail system which is based on web , it\'s allow user to send mail for communication.'
            ],
            [
                'type' => json_encode(['program']),
                'img_path' => 'http://localhost:3000/images/esp8266.gif',
                'title' => 'Automation',
                'badges' => json_encode(['ESP8266', 'Arduino', 'java', 'firebase']),
                'project_link' => '',
                'github_link' => '',
                'desc' => 'This is module based Automation project that provides control with wifi and internet enabled devices'
            ],
            [
                'type' => json_encode(['program']),
                'img_path' => 'http://localhost:3000/images/cpp.gif',
                'title' => 'DBLite',
                'badges' => json_encode(['c++', 'vscode']),
                'project_link' => 'https://github.com/anirbansanu/DBLite',
                'github_link' => 'https://github.com/anirbansanu/DBLite',
                'desc' => 'DBLite is a C++ language library that provides a lightweight disk-based database that doesn\'t require a separate server process'
            ],
            [
                'type' => json_encode(['program']),
                'img_path' => 'http://localhost:3000/images/arduino.gif',
                'title' => 'Home Automation',
                'badges' => json_encode(['Arduino', 'java', 'Android']),
                'project_link' => '',
                'github_link' => '',
                'desc' => 'Home Automation project demonstrates a simple system that allows the user to control it with bluetooth enabled wireless device'
            ],
            [
                'type' => json_encode(['web', 'script']),
                'img_path' => 'http://localhost:3000/images/allinone.png',
                'title' => 'Heart',
                'badges' => json_encode(['html', 'css', 'javascript']),
                'project_link' => 'https://anitechtime.000webhostapp.com/heart.html',
                'github_link' => 'https://anitechtime.000webhostapp.com/heart.html',
                'desc' => 'A Simple animated reaction web app called heart, who react based on input text.'
            ],
            // Add other project data entries here
        ];

        DB::table('projects')->insert($projects);
    }
}
