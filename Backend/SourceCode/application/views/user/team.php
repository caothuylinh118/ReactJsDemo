<?php include 'common/header.php' ?>
    <!-- Team -->
    <section class="slide whiteSlide" name="team" data-midnight="white">
      <div class="content">
        <div class="container">
          <div class="wrap">
            <!-- <div class="katana-10-12 toCenter margin-bottom-5">
              <h2 class="ae-1 sectionTitle">Join our team</h2>
              <div class="ae-2"><p>Got what it takes? If you want to work in a collaborative environment where opportunities are offered, skills are stretched and excellence is rewarded, you might be exactly what we're looking for.</p></div>
            </div> -->
            <div class="katana-12-12">
              <ul class="flex grid-47 margin-top-3 later teams">
                <?php
                // print("<pre>".print_r($team,true)."</pre>");
                foreach ($team as $member) {
                  $avatar = '/files/team/'.$member['image'];
                  echo '<li class="col-4-12">';
                  echo '<div class="katana-4-12 ae-3">';
                  echo '<img src="'.$avatar.'" class="team_image">';
                  echo '<div class="team_body">';
                  echo '<span class="name_team">'.$member['name'].'</span><span class="position_team">'.$member['position'].'</span>';
                  echo '<div class="clear"></div>';
                  echo '<p class="small team-description">'.$member['description'];
                  echo '<br/>';
                  echo '<br/>';
                  $tags = $member['tags'];
                  foreach ($tags as $tag) {
                    echo "#".$tag;
                    echo " ";
                  }
                  echo '</p>';
                  echo '</div>';
                  echo '</div>';
                  echo '</li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Team -->
<?php include 'common/footer.php' ?>
