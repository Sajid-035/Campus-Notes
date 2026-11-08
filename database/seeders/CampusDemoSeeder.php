<?php

namespace Database\Seeders;

use App\Models\AcademicDepartment;
use App\Models\AcademicResource;
use Illuminate\Database\Seeder;

class CampusDemoSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['CSE', 'Computer Science & Engineering', 'computer-science-engineering', 'Programming, software, data and computing resources.', '⌘'],
            ['EEE', 'Electrical & Electronic Engineering', 'electrical-electronic-engineering', 'Circuits, electronics, power and communication resources.', 'ϟ'],
            ['BBA', 'Business Administration', 'business-administration', 'Management, accounting, finance and marketing resources.', '▥'],
            ['CE', 'Civil Engineering', 'civil-engineering', 'Structures, construction and environmental engineering.', '⌂'],
            ['ENG', 'English', 'english', 'Literature, language and communication resources.', '文'],
            ['ECO', 'Economics', 'economics', 'Microeconomics, macroeconomics and policy resources.', '∑'],
            ['LAW', 'Law', 'law', 'Legal studies, case notes and previous examinations.', '§'],
            ['ME', 'Mechanical Engineering', 'mechanical-engineering', 'Mechanics, thermodynamics and manufacturing resources.', '⚙'],
        ];

        foreach ($departments as $index => [$code, $name, $slug, $description, $icon]) {
            AcademicDepartment::updateOrCreate(['code' => $code], [
                'name' => $name, 'slug' => $slug, 'description' => $description,
                'icon' => $icon, 'is_active' => true, 'sort_order' => $index,
            ]);
        }

        if (AcademicResource::exists()) {
            return;
        }

        $samples = [
            ['Data Structures — Class Notes', 'Data Structures', 'CSE 201', 'CSE', 2, 'Class Notes', 'A structured introduction to arrays, linked lists, stacks, queues, trees, graphs and common algorithms.'],
            ['Circuit Analysis — Previous Questions', 'Circuit Analysis', 'EEE 101', 'EEE', 1, 'Previous Questions', 'A revision collection covering DC and AC circuit analysis, network theorems and practical problem patterns.'],
            ['Principles of Marketing — Assignment', 'Principles of Marketing', 'BBA 301', 'BBA', 5, 'Assignments', 'A sample assignment resource about market research, segmentation, targeting and positioning.'],
            ['Microeconomics — Lecture Notes', 'Microeconomics', 'ECO 102', 'ECO', 2, 'Class Notes', 'Core concepts covering demand, supply, elasticity, consumer choice and market equilibrium.'],
            ['Database Systems — Lab Report', 'Database Systems', 'CSE 303', 'CSE', 4, 'Lab Reports', 'Practice material for relational database design, SQL queries, normalization and transactions.'],
            ['Digital Electronics — Slides', 'Digital Electronics', 'EEE 205', 'EEE', 3, 'Lecture Slides', 'A study guide to logic gates, Boolean algebra, combinational and sequential circuits.'],
            ['Business Statistics — Class Notes', 'Business Statistics', 'BBA 202', 'BBA', 3, 'Class Notes', 'Descriptive statistics, probability, distributions, sampling and hypothesis testing.'],
            ['Engineering Mathematics — Previous Questions', 'Engineering Mathematics', 'CSE 105', 'CSE', 1, 'Previous Questions', 'Revision questions on calculus, linear algebra, differential equations and numerical methods.'],
            ['Computer Networks — Lecture Notes', 'Computer Networks', 'CSE 305', 'CSE', 5, 'Class Notes', 'A concise overview of network layers, routing, addressing, transport protocols and security.'],
            ['Financial Accounting — Assignment', 'Financial Accounting', 'BBA 102', 'BBA', 2, 'Assignments', 'Introductory accounting practice on journals, ledgers, trial balances and financial statements.'],
            ['Physics — Lab Report', 'Physics', 'EEE 103', 'EEE', 1, 'Lab Reports', 'Laboratory report guidance for measurement, uncertainty, mechanics and basic electricity.'],
            ['Macroeconomics — Lecture Slides', 'Macroeconomics', 'ECO 202', 'ECO', 4, 'Lecture Slides', 'An overview of national income, inflation, unemployment, fiscal policy and monetary policy.'],
        ];

        foreach ($samples as $index => [$title, $subject, $courseCode, $departmentCode, $semester, $category, $description]) {
            $department = AcademicDepartment::where('code', $departmentCode)->first();
            AcademicResource::create([
                'department_id' => $department?->id,
                'uploader_name' => 'CampusNotes Demo Library',
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title) . '-' . ($index + 1),
                'subject' => $subject,
                'course_code' => $courseCode,
                'semester' => $semester,
                'category' => $category,
                'description' => $description,
                'page_count' => null,
                'rating_average' => 0,
                'rating_count' => 0,
                'downloads_count' => 0,
                'is_verified' => false,
                'is_featured' => $index < 3,
                'status' => 'approved',
                'approved_at' => now(),
            ]);
        }
    }
}
