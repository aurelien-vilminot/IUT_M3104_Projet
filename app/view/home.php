<div class="home">
    <div>
        <p>
            Bienvenue sur FreeNote,<br><br>
            Ce réseau social à pour vocation d'être inutile... Mais bon on a pas le choix de le faire, désolé les gars :(<br><br>
            Plus sérieusement, réseau social d’un nouveau genre, FreeNote consiste à créer des fils de discussions comprenant des messages participatifs au sein desquels chaque utilisateur ne peut ajouter qu’un ou deux mots.
        </p>
    </div>

    <div>
        <table>
            <tr>
                <th>Discussion</th>
                <th>État</th>
            </tr>
            <tr>
                <?php
                foreach ($tabDisc as &$discussion)
                {
                    echo '<td>' . $discussion['title'] . '</td>';
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach ($tabDisc as &$discussion)
                {
                    echo '<td>' . $discussion['state'] . '</td>';
                }
                ?>
            </tr>
        </table>
    </div>
</div>
