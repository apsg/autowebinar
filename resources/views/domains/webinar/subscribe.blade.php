<div class="container">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-header">
                <h4 class="text-center">Zapisz się na ten webinar</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('webinar.subscribe', $webinar) }}" method="post">
                    @csrf
                    <div class="form-group text-center">
                        <label class="">Imię
                            <input class="form-control" type="text" name="name" required>
                        </label>
                    </div>
                    <div class="form-group text-center">
                        <label class="">Adres email
                            <input class="form-control" type="email" name="email" required>
                        </label>
                    </div>
                    <div class="text-center">
                        <button class="btn-primary btn">Zapisz się</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>