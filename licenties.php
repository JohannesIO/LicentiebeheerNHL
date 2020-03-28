<!doctype html>
<html lang="en">

<head>
    <title>Licenties</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                        placeholder="Zoeken">
                </div>
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active">Active item</button>
                    <button type="button" class="list-group-item list-group-item-action">Item</button>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-success btn-block" style="margin: 5px">Licentie
                        toevoegen</button>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary btn-block" style="margin: 5px">Account beheren</button>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <button type="button" class="btn btn-outline-primary" style="margin: 5px">Bijwerken</button>
                    <button type="button" class="btn btn-danger" style="margin: 5px">Verwijderen</button>
                    <form class="form-signin" action="action/action.php?a=logout" method="post">
                        <input type="submit" class="btn btn-primary" value="Logout" name="logout_button" />
                    </form>

                    <label style="margin: 5px">Binnenkort verloopt: Licentie X en Licentie Y</label>


                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Naam licentie</th>
                        </tr>
                        <tr>
                            <th>Doelgroep</th>
                            <th>Hoofdgebruiker</th>
                        </tr>
                        <tr>
                            <th rowspan="2">Beschrijving</th>
                            <th>Licentiecode</th>
                        </tr>
                        <tr>
                            <th>Verleng uitleg</th>
                        </tr>
                        <tr>
                            <th>Vervaldatum</th>
                            <th>Installatie uitleg</th>
                        </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <form id="toevoegen">
                    <div class="row">
                        <div class="form-group">
                            <textarea class="form-control text-center" name="" id="" rows="1"
                                placeholder="Naam Licentie"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="1"
                                    placeholder="Doelgroep"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="12"
                                    placeholder="Beschrijving"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="1"
                                    placeholder="Vervaldatum"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="1"
                                    placeholder="Hoofdgebruiker"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="2"
                                    placeholder="Licentiecode"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="4"
                                    placeholder="Verleng uitleg"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="" id="" rows="6"
                                    placeholder="Installatie uitleg"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" form="toevoegen" action="" class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>

</html>
