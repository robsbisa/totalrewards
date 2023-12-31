<?php
require('dmxConnectLib/dmxConnect.php');

$app = new \lib\App();

$app->exec(<<<'JSON'
{
	"steps": [
		"Connections/db",
		"SecurityProviders/security",
		{
			"module": "auth",
			"action": "restrict",
			"options": {"permissions":"write","loginUrl":"index.php","forbiddenUrl":"402.php","provider":"security"}
		}
	]
}
JSON
, TRUE);
?>
<!doctype html>
<html>

<head>
    <base href="/">
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Rewards Calculator</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer></script>
    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>
</head>

<body is="dmx-app" id="calculator">

    <?php include 'navbar.php'; ?>

    <div class="container my-5 pb-5">
        <div class="row">
            <div class="card px-0">
                <div class="card-header">
                    Reward Calculator
                </div>
                <div class="card-body">
                    <div class="row mx-0 border-bottom border-dark mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Estimate your annual wages:</label>
                                <input class="form-control" placeholder="" value="0" id="AnnualIncome" data-rule-number="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medicare:</label>
                                <input type="number" class="form-control" placeholder="" id="PayrollTax" dmx-bind:value="(AnnualIncome.value * 0.0145).toFixed(2)" readonly="true">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Your matching FICA benefit:</label>
                                <input type="text" class="form-control" placeholder="" id="FICAMedBenifit" dmx-bind:value="(AnnualIncome.value.toNumber() > 167770 ? 10397.40 + PayrollTax.value.toNumber() : AnnualIncome.value.toNumber() * 0.062 + PayrollTax.value.toNumber())" readonly="true">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">How much do you defer to your 403(b) retirement plan? (Percent):</label>
                                <select type="text" class="form-select" required="" id="RetirementPlanPercent">
                                    <option value="0">0%</option>
                                    <option value="1">1%</option>
                                    <option value="2">2%</option>
                                    <option value="3">3%</option>
                                    <option value="4">4%</option>
                                    <option value="5">5%</option>
                                    <option value="6">6%</option>
                                    <option value="7">7%</option>
                                    <option value="8">8%</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Your 403(b) National University match:</label>
                                <input type="text" class="form-control" placeholder="" id="NationalUnivMatch" dmx-bind:value="((RetirementPlanPercent.value<3)?(AnnualIncome.value*0.03).toFixed(2):((RetirementPlanPercent.value>2) &amp;&amp; (RetirementPlanPercent.value<5))?(AnnualIncome.value*0.04).toFixed(2):((RetirementPlanPercent.value>4) &amp;&amp; (RetirementPlanPercent.value<6))?(AnnualIncome.value*0.05).toFixed(2):((RetirementPlanPercent.value>5) &amp;&amp; (RetirementPlanPercent.value<7))?(AnnualIncome.value*0.06).toFixed(2):(RetirementPlanPercent.value>6)?(AnnualIncome.value*0.07).toFixed(2):'')" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 border-bottom border-dark mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Tuition? :</label>
                                <select type="text" class="form-select" required="" id="Tuition">
                                    <option value="0">Did not receive tuition benefit</option>
                                    <option value="1">Received undergraduate tuition benefit</option>
                                    <option value="2">Received graduate tuition benefit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Number of classes:</label>
                                <select type="text" class="form-select" required="" id="NoOfClasses">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Tuition Benefit:</label>
                                <input type="text" class="form-control" placeholder="" dmx-bind:value="((Tuition.value==0)?0.00:(Tuition.value==1)?(NoOfClasses.value*1665).toFixed(2):(Tuition.value==2)?(NoOfClasses.value*1995).toFixed(2):0.00)" readonly="true" id="TuitionBenefit">
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 border-bottom border-dark mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medical plan election:</label>
                                <select type="text" class="form-select" required="" id="MedicalPlanElection">
                                    <option value="HDHP/HSA">HDHP/HSA</option>
                                    <option value="PPO">PPO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medical plan enrollment:</label>
                                <select type="text" class="form-select" required="" id="MedicalPlanEnrollment">
                                    <option value="Self only">Self only</option>
                                    <option value="Self + Spouse">Self + Spouse</option>
                                    <option value="Self + Child(ren)">Self + Child(ren)</option>
                                    <option value="Self + Family">Self + Family</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medical plan employer contribution:</label>
                                <input type="text" class="form-control" placeholder="" id="MedPlanEmpCont" dmx-bind:value="(MedicalPlanElection.value=='PPO')&amp;&amp;(MedicalPlanEnrollment.value=='Self only')?8669.28:(MedicalPlanElection.value=='PPO')&amp;&amp;(MedicalPlanEnrollment.value=='Self + Spouse')?18754.32:(MedicalPlanElection.value=='PPO')&amp;&amp;(MedicalPlanEnrollment.value=='Self + Child(ren)')?15084.96:(MedicalPlanElection.value=='PPO')&amp;&amp;(MedicalPlanEnrollment.value=='Self + Family')?26141.04:(MedicalPlanElection.value=='HDHP/HSA')&amp;&amp;(MedicalPlanEnrollment.value=='Self only')?9443.28:(MedicalPlanElection.value=='HDHP/HSA')&amp;&amp;(MedicalPlanEnrollment.value=='Self + Spouse')?20486.16:(MedicalPlanElection.value=='HDHP/HSA')&amp;&amp;(MedicalPlanEnrollment.value=='Self + Child(ren)')?16478.16:(MedicalPlanElection.value=='HDHP/HSA')&amp;&amp;(MedicalPlanEnrollment.value=='Self + Family')?28337.76:''" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 border-bottom border-dark mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Dental plan enrollment:</label>
                                <select type="text" class="form-select" required="" id="DentalPlanEnrollment">
                                    <option value="Self only">Self only</option>
                                    <option value="Self + Spouse">Self + Spouse</option>
                                    <option value="Self + Child(ren)">Self + Child(ren)</option>
                                    <option value="Self + Family">Self + Family</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Dental plan employer contribution:</label>
                                <input type="text" class="form-control" placeholder="" id="DentPlanEmpContr" dmx-bind:value="((DentalPlanEnrollment.value=='Self only')?0.00:(DentalPlanEnrollment.value=='Self + Spouse')?432.36:(DentalPlanEnrollment.value=='Self + Child(ren)')?615.60:(DentalPlanEnrollment.value=='Self + Family')?908.40:0.00)" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 border-bottom border-dark mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Vision plan enrollment:</label>
                                <select type="text" class="form-select" required="" id="VisionPlanEnroll">
                                    <option value="Self only">Self only</option>
                                    <option value="Self + Spouse">Self + Spouse</option>
                                    <option value="Self + Child(ren)">Self + Child(ren)</option>
                                    <option value="Self + Family">Self + Family</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Vision plan employer contribution:</label>
                                <input type="text" class="form-control" placeholder="" dmx-bind:value="((VisionPlanEnroll.value=='Self only')?0.00:(VisionPlanEnroll.value=='Self + Spouse')?68.88:(VisionPlanEnroll.value=='Self + Child(ren)')?137.28:(VisionPlanEnroll.value=='Self + Family')?205.8:0.00)" readonly="true" id="VisionPlanEmpContr">
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 border-bottom border-dark mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Life insurance benefit:</label>
                                <input type="text" class="form-control" placeholder="" id="LifeInsBenefit" dmx-bind:value="((AnnualIncome.value>399999.99)?600.00:((AnnualIncome.value/1000)*0.134*12).toFixed(2))" readonly="true">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Disability income insurance benefit:</label>
                                <input type="text" class="form-control" placeholder="" id="DisabIncoInsBen" dmx-bind:value="((AnnualIncome.value/100)*0.13).toFixed(2)" readonly="true">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Total Compensation:</label>
                                <input type="text" class="form-control" placeholder="" id="TotalCompensation" dmx-bind:value="(AnnualIncome.value.toNumber()+FICAMedBenifit.value.toNumber()+NationalUnivMatch.value.toNumber()+TuitionBenefit.value.toNumber()+MedPlanEmpCont.value.toNumber()+DentPlanEmpContr.value.toNumber()+VisionPlanEmpContr.value.toNumber()+LifeInsBenefit.value.toNumber()+DisabIncoInsBen.value.toNumber()).toFixed(2)" readonly="true">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Benefits Compensation:</label>
                                <input type="text" class="form-control" placeholder="" id="BenefitsCompensation" dmx-bind:value="(FICAMedBenifit.value.toNumber()+NationalUnivMatch.value.toNumber()+TuitionBenefit.value.toNumber()+MedPlanEmpCont.value.toNumber()+DentPlanEmpContr.value.toNumber()+VisionPlanEmpContr.value.toNumber()+LifeInsBenefit.value.toNumber()+DisabIncoInsBen.value.toNumber()).toFixed(2)" readonly="true">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Benefits as a percentage of total compensation:</label>
                                <input type="text" class="form-control" placeholder="" id="BenPerTotalComp" dmx-bind:value="((BenefitsCompensation.value.toNumber()*100)/TotalCompensation.value.toNumber()).toFixed(2)" readonly="true">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>