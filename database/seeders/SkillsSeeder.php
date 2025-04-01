<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Skill;

class SkillsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Expanded list of real-world IT-related skills
        $realSkills = [
            'Communication',
            'Teamwork',
            'Problem Solving',
            'Time Management',
            'Adaptability',
            'Critical Thinking',
            'Leadership',
            'Creativity',
            'Technical Skills',
            'Project Management',
            'Data Analysis',
            'Programming',
            'Public Speaking',
            'Customer Service',
            'Conflict Resolution',
            'Negotiation',
            'Marketing',
            'Sales',
            'Writing',
            'Research',
            'Design',
            'Networking',
            'Teaching',
            'Financial Management',
            'Strategic Planning',
            // IT-related skills
            'Web Development',
            'Frontend Development',
            'Backend Development',
            'Full Stack Development',
            'Database Management',
            'Cloud Computing',
            'Cybersecurity',
            'DevOps',
            'Machine Learning',
            'Artificial Intelligence',
            'Data Science',
            'Big Data',
            'Mobile App Development',
            'UI/UX Design',
            'Software Testing',
            'Agile Methodologies',
            'Version Control (Git)',
            'API Development',
            'System Administration',
            'IT Support',
            'Network Security',
            'Virtualization',
            'Blockchain',
            'Game Development',
            'Embedded Systems',
            'IoT (Internet of Things)',
            'IT Infrastructure',
            'Technical Writing',
            'IT Consulting',
            'Digital Marketing',
            'SEO (Search Engine Optimization)',
            'IT Project Management',
        ];

        // Insert predefined skills
        foreach ($realSkills as $skillName) {
            Skill::create([
                'name' => $skillName,
            ]);
        }

        // Generate additional skills by randomly selecting from the predefined list
        $numberOfAdditionalSkills = 50; // Define the number of additional skills to create
        for ($i = 0; $i < $numberOfAdditionalSkills; $i++) {
            Skill::create([
                'name' => $faker->unique()->randomElement($realSkills),
            ]);
        }
    }
}