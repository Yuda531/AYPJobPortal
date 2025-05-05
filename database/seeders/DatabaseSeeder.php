<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Employers;
use App\Models\JobSeekers;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create my user
        $agung = User::factory()->create([
            'name' => 'Agung Yuda',
            'email' => 'agung@gmail.com',
            'password' => Hash::make('agung1'),
            'role' => 'employer',
        ]);

        // Create employer profile for Agung
        $agung->employer()->create([
            'company_name' => 'Pratama Corp Indonesia',
            'company_description' => 'Leading technology company in Indonesia',
            'title' => 'CEO',
            'bio' => 'Always innovate and improve',
            'phone' => '081385423875',
            'skills' => 'Java, PHP, JavaScript, Kotlin',
            'location' => 'Bandung'
        ]);

        // Create 15 manual users
        $users = [
            // Employers
            [
                'name' => 'John Tech Corp',
                'email' => 'john@techcorp.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'employer' => [
                    'company_name' => 'Tech Corp Indonesia',
                    'company_description' => 'Leading technology company in Indonesia',
                    'title' => 'HR Manager',
                    'bio' => 'Looking for talented developers',
                    'phone' => '081234567890',
                    'skills' => 'PHP, Laravel, JavaScript',
                    'location' => 'Jakarta'
                ]
            ],
            [
                'name' => 'Sarah Digital',
                'email' => 'sarah@digital.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'employer' => [
                    'company_name' => 'Digital Solutions',
                    'company_description' => 'Digital transformation company',
                    'title' => 'Recruitment Specialist',
                    'bio' => 'Hiring for various tech positions',
                    'phone' => '081234567891',
                    'skills' => 'React, Node.js, MongoDB',
                    'location' => 'Bandung'
                ]
            ],
            [
                'name' => 'Mike Software',
                'email' => 'mike@software.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'employer' => [
                    'company_name' => 'Software House Indonesia',
                    'company_description' => 'Custom software development company',
                    'title' => 'Tech Lead',
                    'bio' => 'Building innovative solutions',
                    'phone' => '081234567892',
                    'skills' => 'Java, Spring Boot, PostgreSQL',
                    'location' => 'Surabaya'
                ]
            ],
            [
                'name' => 'Lisa Startup',
                'email' => 'lisa@startup.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'employer' => [
                    'company_name' => 'Startup Indonesia',
                    'company_description' => 'Innovative startup company',
                    'title' => 'CEO',
                    'bio' => 'Building the future of tech',
                    'phone' => '081234567893',
                    'skills' => 'Python, Django, AWS',
                    'location' => 'Yogyakarta'
                ]
            ],
            [
                'name' => 'David Enterprise',
                'email' => 'david@enterprise.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'employer' => [
                    'company_name' => 'Enterprise Solutions',
                    'company_description' => 'Enterprise software solutions',
                    'title' => 'CTO',
                    'bio' => 'Leading technology innovation',
                    'phone' => '081234567894',
                    'skills' => '.NET, C#, SQL Server',
                    'location' => 'Medan'
                ]
            ],
            // Job Seekers
            [
                'name' => 'Alex Developer',
                'email' => 'alex@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567895',
                    'location' => 'Jakarta',
                    'title' => 'Senior PHP Developer',
                    'bio' => 'Experienced in web development',
                    'skills' => 'PHP, Laravel, MySQL',
                    'experience' => '5 years'
                ]
            ],
            [
                'name' => 'Budi Programmer',
                'email' => 'budi@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567896',
                    'location' => 'Bandung',
                    'title' => 'Frontend Developer',
                    'bio' => 'Passionate about UI/UX',
                    'skills' => 'React, Vue.js, CSS',
                    'experience' => '3 years'
                ]
            ],
            [
                'name' => 'Cindy Designer',
                'email' => 'cindy@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567897',
                    'location' => 'Surabaya',
                    'title' => 'UI/UX Designer',
                    'bio' => 'Creative designer with 4 years experience',
                    'skills' => 'Figma, Adobe XD, Photoshop',
                    'experience' => '4 years'
                ]
            ],
            [
                'name' => 'Denny Mobile',
                'email' => 'denny@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567898',
                    'location' => 'Yogyakarta',
                    'title' => 'Mobile Developer',
                    'bio' => 'Specialized in Android development',
                    'skills' => 'Kotlin, Java, Android SDK',
                    'experience' => '3 years'
                ]
            ],
            [
                'name' => 'Eva Backend',
                'email' => 'eva@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567899',
                    'location' => 'Medan',
                    'title' => 'Backend Developer',
                    'bio' => 'Expert in API development',
                    'skills' => 'Node.js, Express, MongoDB',
                    'experience' => '4 years'
                ]
            ],
            [
                'name' => 'Fajar DevOps',
                'email' => 'fajar@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567900',
                    'location' => 'Jakarta',
                    'title' => 'DevOps Engineer',
                    'bio' => 'Infrastructure and automation expert',
                    'skills' => 'Docker, Kubernetes, AWS',
                    'experience' => '5 years'
                ]
            ],
            [
                'name' => 'Gina Data',
                'email' => 'gina@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567901',
                    'location' => 'Bandung',
                    'title' => 'Data Scientist',
                    'bio' => 'Machine learning enthusiast',
                    'skills' => 'Python, TensorFlow, SQL',
                    'experience' => '3 years'
                ]
            ],
            [
                'name' => 'Hadi Security',
                'email' => 'hadi@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567902',
                    'location' => 'Surabaya',
                    'title' => 'Security Engineer',
                    'bio' => 'Cybersecurity specialist',
                    'skills' => 'Network Security, Penetration Testing',
                    'experience' => '4 years'
                ]
            ],
            [
                'name' => 'Indah QA',
                'email' => 'indah@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567903',
                    'location' => 'Yogyakarta',
                    'title' => 'QA Engineer',
                    'bio' => 'Quality assurance expert',
                    'skills' => 'Selenium, JUnit, TestNG',
                    'experience' => '3 years'
                ]
            ],
            [
                'name' => 'Joko Fullstack',
                'email' => 'joko@email.com',
                'password' => Hash::make('password'),
                'role' => 'job_seeker',
                'job_seeker' => [
                    'phone' => '081234567904',
                    'location' => 'Medan',
                    'title' => 'Fullstack Developer',
                    'bio' => 'Fullstack development expert',
                    'skills' => 'React, Node.js, PostgreSQL',
                    'experience' => '5 years'
                ]
            ]
        ];

        foreach ($users as $userData) {
            $role = $userData['role'];
            $employerData = $userData['employer'] ?? null;
            $jobSeekerData = $userData['job_seeker'] ?? null;

            unset($userData['role'], $userData['employer'], $userData['job_seeker']);


            $user = User::create($userData);

            if ($role === 'employer' && $employerData) {
                $user->employer()->create($employerData);
            } elseif ($role === 'job_seeker' && $jobSeekerData) {
                $user->jobSeeker()->create($jobSeekerData);
            }
        }

        // Create 7 posts 
        $posts = [
            [
                'user_id' => 2,
                'title' => 'Senior PHP Developer Needed',
                'content' => 'Looking for an experienced PHP Developer with strong Laravel skills. Must have minimum 3 years experience.',
                'image' => null,
                'created_at' => now()->subDays(7),
            ],
            [
                'user_id' => 3,
                'title' => 'React Developer Position',
                'content' => 'Join our digital transformation team! We need a React developer with experience in modern web development.',
                'image' => null,
                'created_at' => now()->subDays(6),
            ],
            [
                'user_id' => 4,
                'title' => 'Java Developer Wanted',
                'content' => 'Seeking a Java developer with Spring Boot experience. Must be familiar with microservices architecture.',
                'image' => null,
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => 5,
                'title' => 'Python Developer Opportunity',
                'content' => 'Looking for a Python developer with Django experience. Knowledge of AWS is a plus.',
                'image' => null,
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => 6,
                'title' => '.NET Developer Position',
                'content' => 'Join our enterprise solutions team! We need a .NET developer with C# and SQL Server experience.',
                'image' => null,
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => 7,
                'title' => 'Full Stack Developer Role',
                'content' => 'Seeking a Full Stack Developer with experience in both frontend and backend technologies.',
                'image' => null,
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => 8,
                'title' => 'Frontend Developer Needed',
                'content' => 'Looking for a Frontend Developer with strong Vue.js skills. Experience with modern CSS frameworks required.',
                'image' => null,
                'created_at' => now()->subDay(),
            ],
        ];

        foreach ($posts as $postData) {
            Posts::create($postData);
        }

        // Create 3 comments for each post
        $comments = [
            // Comments for Post 1 (PHP Developer)
            [
                'post_id' => 1,
                'user_id' => 9,
                'content' => 'I have 4 years of experience with Laravel. Would love to discuss this opportunity!',
                'created_at' => now()->subDays(6),
            ],
            [
                'post_id' => 1,
                'user_id' => 10,
                'content' => 'Great opportunity! What is the salary range for this position?',
                'created_at' => now()->subDays(5),
            ],
            [
                'post_id' => 1,
                'user_id' => 11,
                'content' => 'Do you offer remote work options?',
                'created_at' => now()->subDays(4),
            ],

            // Comments for Post 2 (React Developer)
            [
                'post_id' => 2,
                'user_id' => 12,
                'content' => 'I have experience with React and modern web development. How can I apply?',
                'created_at' => now()->subDays(5),
            ],
            [
                'post_id' => 2,
                'user_id' => 13,
                'content' => 'What is the tech stack you are using?',
                'created_at' => now()->subDays(4),
            ],
            [
                'post_id' => 2,
                'user_id' => 14,
                'content' => 'Is there a possibility for career growth in this position?',
                'created_at' => now()->subDays(3),
            ],

            // Comments for Post 3 (Java Developer)
            [
                'post_id' => 3,
                'user_id' => 15,
                'content' => 'I have experience with Spring Boot. What are the main responsibilities?',
                'created_at' => now()->subDays(4),
            ],
            [
                'post_id' => 3,
                'user_id' => 16,
                'content' => 'Do you provide training for new technologies?',
                'created_at' => now()->subDays(3),
            ],
            [
                'post_id' => 3,
                'user_id' => 9,
                'content' => 'What is the team size for this position?',
                'created_at' => now()->subDays(2),
            ],

            // Comments for Post 4 (Python Developer)
            [
                'post_id' => 4,
                'user_id' => 10,
                'content' => 'I have Django experience. What is the project scope?',
                'created_at' => now()->subDays(3),
            ],
            [
                'post_id' => 4,
                'user_id' => 11,
                'content' => 'Do you use any specific AWS services?',
                'created_at' => now()->subDays(2),
            ],
            [
                'post_id' => 4,
                'user_id' => 12,
                'content' => 'What is the development process in your company?',
                'created_at' => now()->subDay(),
            ],

            // Comments for Post 5 (.NET Developer)
            [
                'post_id' => 5,
                'user_id' => 13,
                'content' => 'I have C# experience. What is the salary range?',
                'created_at' => now()->subDays(2),
            ],
            [
                'post_id' => 5,
                'user_id' => 14,
                'content' => 'Do you have any specific security requirements?',
                'created_at' => now()->subDay(),
            ],
            [
                'post_id' => 5,
                'user_id' => 15,
                'content' => 'What is the testing process in your team?',
                'created_at' => now(),
            ],

            // Comments for Post 6 (Full Stack Developer)
            [
                'post_id' => 6,
                'user_id' => 16,
                'content' => 'I am a full stack developer. What technologies do you use?',
                'created_at' => now()->subDay(),
            ],
            [
                'post_id' => 6,
                'user_id' => 9,
                'content' => 'Do you have any design requirements?',
                'created_at' => now(),
            ],
            [
                'post_id' => 6,
                'user_id' => 10,
                'content' => 'What is the project timeline?',
                'created_at' => now(),
            ],

            // Comments for Post 7 (Frontend Developer)
            [
                'post_id' => 7,
                'user_id' => 11,
                'content' => 'I have Vue.js experience. What is the team structure?',
                'created_at' => now(),
            ],
            [
                'post_id' => 7,
                'user_id' => 12,
                'content' => 'Do you use any specific deployment tools?',
                'created_at' => now(),
            ],
            [
                'post_id' => 7,
                'user_id' => 13,
                'content' => 'What is the work environment like?',
                'created_at' => now(),
            ],
        ];

        foreach ($comments as $commentData) {
            Comment::create($commentData);
        }
    }
}
