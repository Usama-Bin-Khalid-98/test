<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Dashboard']);
        Permission::create(['name' => 'Invoice']);
        Permission::create(['name' => 'RegistrationApplication']);
        Permission::create(['name' => 'Users']);
        Permission::create(['name' => 'Curriculum']);
        Permission::create(['name' => 'Students']);
        Permission::create(['name' => 'Faculty']);
        Permission::create(['name' => 'ResearchDevelopment']);
        Permission::create(['name' => 'FacilityInformation']);
        Permission::create(['name' => 'SocialResponsibility']);
        Permission::create(['name' => 'DepartmentFee']);
        Permission::create(['name' => 'FacultyDegree']);
        Permission::create(['name' => 'DeskReview']);
        Permission::create(['name' => 'NbeacCriteria']);
        Permission::create(['name' => 'EligibilityScreening']);
        Permission::create(['name' => 'AdminDashboard']);
        Permission::create(['name' => 'SystemSetting']);
        Permission::create(['name' => 'Mentoring']);
        Permission::create(['name' => 'SelfAssessmentProcess']);
        Permission::create(['name' => 'SARDeskReview ']);
        Permission::create(['name' => 'PeerReview']);
        Permission::create(['name' => 'AccreditationAwardCommittee']);
        Permission::create(['name' => 'CouncilMeeting']);
        Permission::create(['name' => 'Reports']);
        Permission::create(['name' => 'ESScheduler']);

        // create roles and assign created permissions

        // this can be done as separate statements
//        $NBEACAdmin = Role::create(['name' => 'NBEACAdmin']);
//        $BusinessSchool = Role::create(['name' => 'BusinessSchool']);
//        $DeskReviewer = Role::create(['name' => 'DeskReviewer']);
//        $role->givePermissionTo('edit articles');

        // or may be done by chaining
        $BusinessSchool = Role::create(['name' => 'BusinessSchool'])
            ->givePermissionTo([
                'Invoice',
                'RegistrationApplication',
                'Curriculum',
                'Students',
                'Faculty',
                'ResearchDevelopment',
                'FacilityInformation',
                'SocialResponsibility',
                'FacultyDegree',
                'SelfAssessmentProcess',
                ]
            );

        $PeerReviewer = Role::create(['name' => 'PeerReviewer'])
            ->givePermissionTo([
                'PeerReview',
                ]
            );

        $ESScheduler = Role::create(['name' => 'ESScheduler'])
            ->givePermissionTo([
                'ESScheduler',
                ]
            );



        $NBEACAdmin = Role::create(['name' => 'NBEACAdmin']);
        $NBEACAdmin->givePermissionTo(Permission::all());

        $NbeacFocalPerson = Role::create(['name' => 'NbeacFocalPerson']);
        $NbeacFocalPerson->givePermissionTo(Permission::all());

        $EligibilityScreening = Role::create(['name' => 'EligibilityScreening'])
            ->givePermissionTo(['EligibilityScreening']);

        $Mentor = Role::create(['name' => 'Mentor'])
            ->givePermissionTo(['Mentoring']);

        $AccreditationAwardCommittee = Role::create(['name' => 'AccreditationAwardCommittee'])
        ->givePermissionTo(['AccreditationAwardCommittee']);

        $councilMeeting = Role::create(['name' => 'CouncilMeeting'])
        ->givePermissionTo(['CouncilMeeting']);

        // admin
        $admin = User::find(1);
        $admin->assignRole('NBEACAdmin');



    }
}
