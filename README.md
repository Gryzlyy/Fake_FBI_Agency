# Fake_FBI_Agency
Bonjour, j'ai eu un problème lors de mon premier projet Symfony, je l'avais initialisé avec la mauvaise commande. 
Ce qui fait que je n'arrivais pas à le mettre en ligne. J'ai donc décidé de tout refaire sur un nuveau projet Symfony.
C'est pour cette raison qu'il n'y a pas beaucoup de commit.
Pour votre information, afin de faire preuve de bonne foie, je ous mets le lien du premier projet avce les commits originel : https://github.com/Gryzlyy/FBI_APP_Paul_Faguet.

Identifiants de connexion en tant qu'administrateur : 
adresse mail : admin@fbi.com,
mot de passe : password

Url du site web : https://fakefbiagency.obicorp.fr

/**
     * @Route("/banker/requests", name="banker_requests")
     */
    public function requests(RequestRepository $requestRepository): Response
    {
        return $this->render('banker/requests.html.twig', [
            'requests' => $requestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/banker/requests-add", name="banker_requests_add")
     */
    public function add(RequestRepository $requestRepository): Response
    {
        return $this->render('banker/requests.html.twig', [
            'requests' => $requestRepository->findAll(),
        ]);
    }
    
    {% extends'base.html.twig' %}
    
    {% block body %}
        {% include '_navbarBanker.html.twig' %}
    
        <div class="mt-5" style="background-color: #DEE5E9; width: 90vw; margin-left: auto; margin-right: auto">
            <div style="border-radius: 10%">
                <table class="table table-hover table-responsive text-center align-middle">
                    <thead>
                    <tr>
                        <th scope="col">IDs</th>
                        <th scope="col">Objets des demandes</th>
                        <th scope="col">Auteurs des demandes</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        {% for request in requests %}
                            <tr>
                                <td>
                                    {{ request.id }}
                                </td>
                                <td style="background-color:
                                    {% if request.object == 'Suppression' %}
                                            #F1948A
                                    {% elseif request.object == 'Ajout bénéficiaire'%}
                                                #F8C471
                                            {% elseif request.object == 'Création de compte' %}
                                                lightgreen
                                                {% endif %}
                                    ">
                                    {{ request.object }}
                                </td>
                                    <td>
                                        <a href="#">
                                            {{ request.client.firstname }} {{ request.client.lastname }}
                                        </a>
                                    </td>
                                <td>
                                    Valider / Refuser
                                </td>
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    {% endblock %}