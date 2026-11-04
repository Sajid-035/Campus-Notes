<?php
namespace Database\Seeders;
use App\Models\Department;
use App\Models\ResourceItem;
use Illuminate\Database\Seeder;

class CampusNotesDemoSeeder extends Seeder {
 public function run(): void {
  $rows=[
   ['Computer Science & Engineering','CSE','Computing and software engineering.'],
   ['Electrical & Electronic Engineering','EEE','Electrical systems and electronics.'],
   ['Business Administration','BBA','Business, management and finance.'],
   ['English','ENG','Language and literature.'],
   ['Mathematics','MATH','Pure and applied mathematics.'],
   ['Physics','PHY','Classical and modern physics.'],
   ['Chemistry','CHEM','Chemical sciences.'],
   ['Civil Engineering','CE','Structures and infrastructure.']
  ];
  foreach($rows as [$name,$code,$description]) Department::firstOrCreate(['code'=>$code],compact('name','code','description')+['is_active'=>true]);
  $cse=Department::where('code','CSE')->first(); $eee=Department::where('code','EEE')->first(); $bba=Department::where('code','BBA')->first();
  $samples=[
   [$cse,'Introduction to Programming – Lecture Notes','Variables, conditions, loops and functions.','Class Notes','Structured Programming','CSE 101','1st Semester','approved',124],
   [$cse,'Data Structures – Previous Questions','Practice set on arrays, stacks, queues, trees and graphs.','Previous Questions','Data Structures','CSE 203','3rd Semester','approved',98],
   [$cse,'Database Management Systems – Slides','Relational databases, normalization, SQL and transactions.','Lecture Slides','Database Management Systems','CSE 305','5th Semester','approved',76],
   [$cse,'Software Engineering – Assignment','Requirements engineering, UML and software processes.','Assignments','Software Engineering','CSE 307','5th Semester','pending',0],
   [$eee,'Circuit Analysis – Lab Report','Sample lab report on basic circuit measurements.','Lab Reports','Circuit Analysis','EEE 201','3rd Semester','approved',54],
   [$bba,'Principles of Marketing – Notes','Marketing fundamentals, segmentation and positioning.','Class Notes','Principles of Marketing','BBA 203','2nd Semester','approved',43]
  ];
  foreach($samples as [$dept,$title,$desc,$cat,$subject,$code,$semester,$status,$downloads]) ResourceItem::firstOrCreate(['title'=>$title],[
   'department_id'=>$dept->id,'description'=>$desc,'category'=>$cat,'subject'=>$subject,'subject_code'=>$code,
   'semester'=>$semester,'academic_year'=>'2025-26','uploader_name'=>'CampusNotes Demo Contributor',
   'file_path'=>null,'original_filename'=>'No sample PDF attached','file_size'=>0,'status'=>$status,'downloads'=>$downloads
  ]);
 }
}
