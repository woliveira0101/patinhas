<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<div class="full-width-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex"
                style="height: 450px; background-image: url(/assets/img/quero_adotar.png); background-position: center; background-size: cover;">
                <a href="animais.html" class="d-flex flex-column py-5 px-2 mb-auto ms-1 destaque-zoom"
                    style="text-decoration: none; font-size: 54px; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.8);"><span
                    class="text-light ">Quero</span><span class="text-light fw-bold">Adotar!</span></a>
            </div>
            <div class="col d-flex"
                style="height: 450px; background-image: url(/assets/img/quero_doar.png); background-position: center; background-size: cover;">
                <a href="form_doacao.html"
                    class="d-flex flex-column py-5 px-4 justify-content-end mt-auto ms-auto destaque-zoom"
                    style="text-decoration: none; font-size: 54px; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.85);"><span
                    class="text-light ">Quero</span> <span class="text-light fw-bold">Doar!</span></a>
            </div>
        </div>
    </div>
</div>

<style>
.destaque-zoom:hover {
    transform: scale(1.07);
    transition: transform 0.6s;
}
</style>

<section class="container text-center">
    <h1 class="text-center mt-4">Eles estão esperando por você!</h1>
    <div class="row ms-4">
        <div class="col my-2 my-sm-5 ms-sm-5">
            <div class="card" style="width: 18rem;"><img src="/assets/img/pets/pet_1.jpg" class="card-img-top" alt="..."
                    style="max-height: 170px; object-fit: cover; object-position: center;">
                <div class="card-body text-center">
                    <h5 class="card-title text-center">Steve Jobson</h5>
                    <p class="card-text text-center p-2">Esse amiguinho quer muito te acompanhar nas suas aventuras.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Basset</li>
                    <li class="list-group-item text-center">5 anos</li>
                    <li class="list-group-item text-center">Franca - São Paulo</li>
                </ul>
                <div class="card-body d-flex justify-content-center"><a href="animal_detalhes.html"
                        class="card-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Quero
                        conhecer melhor !</a></div>
            </div>
        </div>
        <div class="col my-2 my-sm-5">
            <div class="card" style="width: 18rem;"><img src="/assets/img/pets/pet_2.jpg" class="card-img-top" alt="..."
                    style="max-height: 170px; object-fit: cover; object-position: center;">
                <div class="card-body text-center">
                    <h5 class="card-title text-center">Marco Zuckerdog</h5>
                    <p class="card-text text-center p-2">Companheiro fiel e protetor da família.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Bulldog</li>
                    <li class="list-group-item text-center">6 anos</li>
                    <li class="list-group-item text-center">Franca - São Paulo</li>
                </ul>
                <div class="card-body d-flex justify-content-center"><a href="animal_detalhes.html"
                        class="card-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Quero
                        conhecer melhor !</a></div>
            </div>
        </div>
        <div class="col my-2 my-sm-5 mx-auto">
            <div class="card" style="width: 18rem;"><img src="/assets/img/pets/pet_3.jpg" class="card-img-top" alt="..."
                    style="max-height: 170px; object-fit: cover; object-position: center;">
                <div class="card-body text-center">
                    <h5 class="card-title text-center">Bill Cattes </h5>
                    <p class="card-text text-center">Esse bichano é esperto,
                        calmo e carinhoso. Ideal para casas ou apartamentos pequenos.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Shorthair</li>
                    <li class="list-group-item text-center">4 anos</li>
                    <li class="list-group-item text-center">Franca - São Paulo</li>
                </ul>
                <div class="card-body d-flex justify-content-center"><a href="animal_detalhes.html"
                        class="card-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Quero
                        conhecer melhor !</a></div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center"><a href="animais.html" type="button"
            class="btn btn-warning btn-lg m-3 mb-5">Veja mais amiguinhos disponíveis</a></div>
</section>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
