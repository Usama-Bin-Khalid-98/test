<?php

use Illuminate\Database\Seeder;

class NbeacCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nbeac_criterias')->insert([
            ['program_started' => '<p>At least 3 batches of the degree should have passed to consider the program for accreditation.</p>  <ol> 	<li>BBA after 5.5 years of program started</li> 	<li>MBA 1.5 after 2.5 years of program started</li> 	<li>MBA 2.5 after 3.5 years of program started</li> </ol>  <p>MBA 3.5 after 5 years of program started.</p>',
             'mission_vision_statement' => '<p>Vision and mission should exist, realistic and shared among the all stake holders. Mission statement of business school is clear, current and aligned with its vision statement.</p>  <p>There should be documentary evidence that vision and mission are approved by any statutory body.</p>  <p>The vision and mission should be displayed on the Department&#39;s webpage. There should be synchronization between both versions i.e.&nbsp; Presented to NBEAC and displayed on website.</p>',
             'strategic_plan' => '<p>Strategic Plan should exist for 03-05 years</p>',
             'student_intake' => '<ol> 	<li>Student Intake(Table 2.3)</li> </ol>',
             'student_enrollment' => '<p>Class Size:</p>  <ul> 	<li>Undergraduate/ semester: 20-55 students</li> 	<li>Graduates/semester: 15-45 students</li> 	<li> 	<p>There should be minimum of 15 full time faculty members related to Management Sciences/ Business Administration field. (condition for Table 4.1)</p>  	<p>Preferably, there should be 03 faculty members at Prof/Associate Prof level, however, minimum 02 Associate Professors and 03 at Assistant Professors are required to become eligible for accreditation process. (Condition for Table 4.3a)</p>  	<p><br /> 	Faculty Diversity(In breeding)&nbsp;&nbsp;&nbsp;&nbsp; Less Than 25%&nbsp;</p>  	<p>International Exposure of the faculty&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 20%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>  	<p>FT:PT= 70:30 (Condition for table 4.4.)</p>  	<p>Student to Teacher Ratio=25:1 (undergraduate) 20:1 (graduate)</p> 	(Condition for Table 4.4.)</li> </ul>',
             'course_load' => '<p>Following is the recommended Course load</p>  <p>Lecturer= 3-4 per semester/ 6-8 per annum</p>  <p>Assistant Professor= 3 per semester/6 per annum</p>  <p>Associate Professor/ Professor=2-3 per semester/4-6 per annum</p>',
             'research_output' => '<p>Research Output last three years (Table 5.1</p>',
             'bandwidth' => '<p>Bandwidth Internet service (desirable) = 1 MB access rate</p>  <ol> 	<li>summary of research output)</li> </ol>  <p>Academic Research</p>  <ol> 	<li>Impact factor journals</li> 	<li>HEC category W</li> 	<li>HEC category X</li> 	<li>HEC category Y</li> 	<li>ABS or ABDC listing</li> 	<li>Other listings (Table 5.1-total number of items)</li> 	<li>Conference paper national: &nbsp;&nbsp;(Table 5.1)</li> 	<li>Conference paper international: &nbsp;(table 5.1)</li> 	<li>Published case studies: &nbsp;(table 5.1)</li> 	<li>Consultancy projects: &nbsp;(table 5.1)</li> </ol>',
             'std_comp_ratio' => '<p>Bandwidth Internet service (desirable) = 1 MB access rate</p>  <p>Student to Computer ratio: 1:20</p>',
        ],
        ]);
    }
}
