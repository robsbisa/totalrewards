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
</head>

<body is="dmx-app" id="calculator">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Rewards Calculator</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="users.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calculator.php">Calculator</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5 pb-5">
        <div class="row">
            <div class="card px-0">
                <div class="card-header">
                    Rewards Calculator
                </div>
                <div class="card-body">
                    <div class="row mx-0">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Estimate your annual wages:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medicare:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Your matching FICA/ Medicare benefit:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">How much do you defer to your 403(b) retirement plan? (Percent):</label>
                                <select type="text" class="form-select" required="">
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
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Tuition? :</label>
                                <select type="text" class="form-select" required="">
                                    <option value="1">Did not receive tuition benefit</option>
                                    <option value="2">Received undergraduate tuition benefit</option>
                                    <option value="3">Received graduate tuition benefit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Number of classes:</label>
                                <select type="text" class="form-select" required="">
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
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medical plan election:</label>
                                <select type="text" class="form-select" required="">
                                    <option value="HDHP/HSA">HDHP/HSA</option>
                                    <option value="PPO">PPO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Medical plan enrollment:</label>
                                <select type="text" class="form-select" required="">
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
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Dental plan enrollment:</label>
                                <select type="text" class="form-select" required="">
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
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Vision plan enrollment:</label>
                                <select type="text" class="form-select" required="">
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
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Life insurance benefit:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Disability income insurance benefit:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Total Compensation:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Benefits compensation:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="inp_fname" class="form-label">Benefits as a percentage of total compensation:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted navbar-dark fixed-bottom">
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="#">Ariful</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>