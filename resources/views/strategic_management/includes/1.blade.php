<br><h1 class="center">1. Strategic Management</h1>
<p class="left">1.1.	Provide basic information about the business school in Table 1.1. The term “school” is used in the NBEAC process to designate the entity that is applying for NBEAC accreditation, whether it is a free standing business school or a faculty, school or department within a university.</p>
					@include('strategic_management.includes.1_1')
					<br><p class="left">1.2.	Provide scope of accreditation in Table 1.2.</p>
                    @include('strategic_management.includes.1_2')
                    <br><p class="left">1.3.	Provide contact information in Table 1.3 and attach CVs of the dean, head of the business school, and focal person as Appendix-1A.</p>
                    @include('strategic_management.includes.1_3')
                    <br><p class="left">1.4.	Provide information about statutory bodies in Table 1.4. Also attach documentary information about the composition, name of members, role and functions of each statutory body as Appendix-1B. </p>
                    @include('strategic_management.includes.1_4')
                    <br><p class="left">1.5.	Provide details in Table 1.5 about the names, designations and affiliations of all external members (academic/corporate/international) in each of the statutory bodies listed in Table 1.4.</p>
                    @include('strategic_management.includes.1_5')
                    <br><p class="left">1.6. Summarize policy of the business school to ensure administrative, academic financial autonomy to a reasonable extent. </p>
                     <p class="left">{{ strip_tags(@$summary_policy->summary) }}</p>
                    <br>
                    <p class="left">1.7.	Provide budgetary information of the business school in Table 1.6 (note that year t refers to the fiscal year in which the accreditation assessment visit is taking place)</p>
                    @include('strategic_management.includes.1_6')
                    <br><p class="left">1.8.	Provide information on funding sources of the business school in Table 1.8. </p>
                    @include('strategic_management.includes.1_7')
                    <br><p class="left">1.9.	Provide the latest audit report of the business school as Appendix -1C.</p>
                    <p class="left">1.10.	State the vision and mission of the university and of the business school. Describe the process of formation and approval of the vision and mission statements. Attach relevant pages of the official documents as Appendix-1D.</p>
                    <p class="left">1.11.	Provide the approved strategic plan including critical success factors and key performance indicators of the business school as Appendix-1E.  Fill in the required information on approval of the strategic plan in Table 1.8.</p>
                    @include('strategic_management.includes.1_8')
