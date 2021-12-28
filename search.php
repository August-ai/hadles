<?php

  require "Search_header.php";

  if (isset($_POST['add_cart']) && isset($_POST['organization_id'])) {

    $sql = "SELECT organization_id FROM user_cart WHERE organization_id=? AND user_id=?";
    $stmt = mysqli_stmt_init($conn);

    $o_n = mysqli_real_escape_string($conn, $_POST['organization_id']);


    if ((!mysqli_stmt_prepare($stmt,$sql))) {
      header("Location: mainpage.php?errorS=sqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt,"ii",$o_n,$session);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);

      $resultCheck = mysqli_stmt_num_rows($stmt);


      $z = false;

        if ($resultCheck >= 1) {

        }else {
            if (!$z) {
                  $sql="INSERT INTO user_cart(organization_id, user_id) VALUES (?,?)";
                  $stmt = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt,$sql)) {
                  }
                  else{
                    mysqli_stmt_bind_param($stmt,"ii",$o_n,$session);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    $z = true;
                  }
                }else {

                }
          }
      }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo "$o_n";
    exit;
  }

  // set post unlike
  // if (isset($_POST['remove_cart']) && isset($_POST['organization_id'])) {
  //
  //   $sql = "SELECT organization_id FROM user_cart WHERE organization_id=? AND user_id=?";
  //   $stmt = mysqli_stmt_init($conn);
  //
  //   $o_n = mysqli_real_escape_string($conn, $_POST['organization_id']);
  //
  //
  //   if ((!mysqli_stmt_prepare($stmt,$sql))) {
  //     header("Location: mainpage.php?errorS=sqlerror");
  //     exit();
  //   }
  //   else{
  //     mysqli_stmt_bind_param($stmt,"ii",$o_n,$_SESSION['userId']);
  //     mysqli_stmt_execute($stmt);
  //     mysqli_stmt_store_result($stmt);
  //
  //     $resultCheck = mysqli_stmt_num_rows($stmt);
  //
  //
  //     $z = false;
  //
  //       if ($resultCheck >= 1) {
  //         if (!$z) {
  //               $sql="DELETE FROM user_cart WHERE user_id=? AND organization_id=?";
  //               $stmt = mysqli_stmt_init($conn);
  //               if (!mysqli_stmt_prepare($stmt,$sql)) {
  //               }
  //               else{
  //                 mysqli_stmt_bind_param($stmt,"ii",$_SESSION['userId'],$o_n);
  //                 mysqli_stmt_execute($stmt);
  //                 mysqli_stmt_store_result($stmt);
  //
  //                 $z = true;
  //               }
  //             }else {
  //
  //             }
  //       }else {
  //       }
  //     }
  //   mysqli_stmt_close($stmt);
  //   mysqli_close($conn);
  //
  //   echo "$o_n";
  //   exit;
  // }

  if (empty($search)) {
    header("Location: mainpage.php?emptysearch");
    exit();
  }else {


    $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);
    if ($queryResult < 1) {
      echo "<div class='search-box-page'>";
      echo "<div class='main-search-result-box'><br><div>Results for <strong>''$simple_search''</strong>:</div>";
      echo "<div>
        <p>No results matching your search:
        </p>
        <ul class='repos_li'>
          <li>Check your spealing</li>
          <li>Use keywords</li>
        </ul>
      </div>";
    }
    else if ($queryResult == 1) {
      echo "<div class='search-box-page'>";
      echo "<div class='main-search-result-box'><div class='result_search-t'>Results for <strong>''$simple_search''</strong>:</div>";
      echo "<div class='top_box-containerSF_cmplte'>
      <div class='top_box-containerSF'>
        <div class='search-result_box'>Results for <strong>''$simple_search''</strong>:</div>
        <div class='search-filter_box filter_m-bt' id='m_filter_bid'>Filter <i class='fas fa-sort-down down-arrw_repos' id='arr_pos-id'></i></div>
      </div>

      </div>
      <Div class='top_bconn nagasaki'></div>
      <ul class='filter-box filter-box_full-width nagasaki'>
        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Date</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Recent</span>
                  </a>
                </label>
              </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_2' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                  <input id='cbx_2' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Less Recent</span>
                </a>
              </label>
            </div>
          </li>

        </ul>

        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Fight For</h4>
        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_3' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                <input id='cbx_3' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Hunger</span>
              </a>
            </label>
          </div>
        </li>


        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_4' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                <input id='cbx_4' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Poverty</span>
              </a>
            </label>
          </div>
        </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_5' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx_5' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger and Poverty</span>
                </a>
              </label>
            </div>
          </li>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_6' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                  <input id='cbx_6' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Abusation</span>
                </a>
              </label>
            </div>
          </li>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_7' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                  <input id='cbx_7' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Diseases</span>
                </a>
              </label>
            </div>
          </li>
        </ul>

        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Ordered By</h4>

        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_8' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                <input id='cbx_8' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Most Popular</span>
              </a>
            </label>
          </div>
        </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_9' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                  <input id='cbx_9' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Donations</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_10' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                  <input id='cbx_10' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Likes</span>
                </a>
              </label>
            </div>
          </li>
        </ul>

        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Type</h4>
        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_11' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                <input id='cbx_11' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Large Organizations</span>
              </a>
            </label>
          </div>
        </li>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_12' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                  <input id='cbx_12' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Medium Organizations</span>
                </a>
              </label>
            </div>
          </li>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_13' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                  <input id='cbx_13' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Small Organizations</span>
                </a>
              </label>
            </div>
          </li>
        </ul>
      </ul>
        <br>";

      echo "<div class='flex-containers'>";
      echo " <br><div class='organizations_search'>";
              $num_char = strlen($search);
              $space_char = substr_count($search_space, ' ');

              $row_class = 1;
              while ($row = mysqli_fetch_assoc($result)) {


                $row_id = $row["organization_id"];
                $count = 0;
                $count2 = 0;
                $org_name_n_space = str_replace(' ', '', $row['organization_name']);
                foreach (str_split(strtolower($row['organization_name'])) as $id) {
                  $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
                  $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
                  if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                      // no space
                      if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                        $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                        echo "<div class='search-box-container'>";
                        $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                        $final_result_name_uc = ucwords($final_result_name);
                        echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';

                        echo '<div class="org-logo">
                         <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                         <div class="choice-user">
                         <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                       $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                       $stmt_cart = mysqli_stmt_init($conn);


                       if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                         header("Location: mainpage.php?errorS=sqlerror");
                         exit();
                       }
                       else{
                         mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                         mysqli_stmt_execute($stmt_cart);
                         mysqli_stmt_store_result($stmt_cart);

                         $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                         $z = false;

                           if ($resultCheck >= 1) {
                              echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                             echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                           }else {
                              echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                             // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';

                         }
                       }

                         echo '</div>
                         </div>';
                        echo '';
                        echo "</div>";
                        break;
                      }
                        // space(s)
                      else {
                        $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                        echo "<div class='search-box-container'>";
                        $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                        $final_result_name_uc = ucwords($final_result_name);
                        echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                        echo '<div class="org-logo">
                         <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                         <div class="choice-user">
                         <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                       $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                       $stmt_cart = mysqli_stmt_init($conn);


                       if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                         header("Location: mainpage.php?errorS=sqlerror");
                         exit();
                       }
                       else{
                         mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                         mysqli_stmt_execute($stmt_cart);
                         mysqli_stmt_store_result($stmt_cart);

                         $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                         $z = false;

                         if ($resultCheck >= 1) {
                            echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                           echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                         }else {
                           echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case'.$row_class.'" id="check-user" data-row="'.$row_class.'">Check</button></a>';



                           // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                       }
                       }

                         echo '</div>
                         </div>';
                        echo '';
                        echo "</div>";
                        break;
                      }
                  }
                  else {
                    $count++;
                  }
                }
              }
              echo "</div>";

                            mysqli_close($conn);
      // 0 filter



      // <span>
      //   <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
      //     <div class='r_pos'>
      //     <label for='most_recent' class='p_curs n_marg'>
      //       <input type='checkbox' class='p_curs'>
      //       <i></i>
      //       <span class='v_align'>Most Recent</span>
      //     </label>
      //     </div>
      //   </a>
      // </span>
    }else if($queryResult >= 2){
      echo "<div class='search-box-page'>";
      echo "<div class='main-search-result-box'><div class='result_search-t'>Results for <strong>''$simple_search''</strong>:</div>";
      echo "<div class='top_box-containerSF_cmplte'>
      <div class='top_box-containerSF'>
        <div class='search-result_box'>Results for <strong>''$simple_search''</strong>:</div>
        <div class='search-filter_box filter_m-bt' id='m_filter_bid'>Filter <i class='fas fa-sort-down down-arrw_repos' id='arr_pos-id'></i></div>
      </div>

      </div>
      <Div class='top_bconn nagasaki'></div>
      <ul class='filter-box filter-box_full-width nagasaki'>
        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Date</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Recent</span>
                  </a>
                </label>
              </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_2' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                  <input id='cbx_2' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Less Recent</span>
                </a>
              </label>
            </div>
          </li>

        </ul>

        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Fight For</h4>
        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_3' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                <input id='cbx_3' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Hunger</span>
              </a>
            </label>
          </div>
        </li>


        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_4' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                <input id='cbx_4' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Poverty</span>
              </a>
            </label>
          </div>
        </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_5' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx_5' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger and Poverty</span>
                </a>
              </label>
            </div>
          </li>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_6' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                  <input id='cbx_6' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Abusation</span>
                </a>
              </label>
            </div>
          </li>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_7' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                  <input id='cbx_7' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Diseases</span>
                </a>
              </label>
            </div>
          </li>
        </ul>

        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Ordered By</h4>

        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_8' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                <input id='cbx_8' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Most Popular</span>
              </a>
            </label>
          </div>
        </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_9' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                  <input id='cbx_9' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Donations</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_10' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                  <input id='cbx_10' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Likes</span>
                </a>
              </label>
            </div>
          </li>
        </ul>

        <ul class='filter-row'><h4 class='filter-row-title filter-row-title_f'>Type</h4>
        <li class='fliter-row-base'>
          <div class='cntr'>
              <label for='cbx_11' class='label-cbx-filter'>
              <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                <input id='cbx_11' type='checkbox' name='donation-checkbox' class='invisible'>
                <div class='checkbox checkbox_n_p'>
                  <svg class='svg-filter' viewBox='0 0 20 20'>
                    <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                    C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                    <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                  </svg>
                </div>
                <span class='checkbox-text'>Large Organizations</span>
              </a>
            </label>
          </div>
        </li>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_12' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                  <input id='cbx_12' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Medium Organizations</span>
                </a>
              </label>
            </div>
          </li>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_13' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                  <input id='cbx_13' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Small Organizations</span>
                </a>
              </label>
            </div>
          </li>
        </ul>
      </ul>
        <br>";
      if (!isset($_GET["f"])) {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_2' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                    <input id='cbx_2' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_3' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                  <input id='cbx_3' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_4' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx_4' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_5' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                    <input id='cbx_5' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_6' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                    <input id='cbx_6' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_7' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                    <input id='cbx_7' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_8' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                  <input id='cbx_8' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_9' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                    <input id='cbx_9' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_10' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                    <input id='cbx_10' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx_11' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                  <input id='cbx_11' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_12' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                    <input id='cbx_12' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx_13' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                    <input id='cbx_13' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>

        </div>
        </div>
        <div class='organizations_search'>";
        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {


          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }
      // 1 filter
      else if ($_GET['f'] == "tmr") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";
        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY all_organizations.time DESC";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "tlr") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY all_organizations.time ASC";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }
      else if ($_GET["f"] == "fht") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_fight = 'hunger'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "fpt") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul><ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link' target='_self'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link' target='_self'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_fight = 'poverty'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "fhpt") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_fight = 'hunger&poverty'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";
                mysqli_close($conn);
      }else if ($_GET["f"] == "fah") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_fight = 'abusation'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "lsk") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";


        $duplicate_array = array();
        $sql = "SELECT * FROM all_organizations,organizations_img, user_liked WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =  LOWER(REPLACE(user_liked.liked_organization_name,' ', '')) ORDER BY all_organizations.likes DESC";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;


        while ($row = mysqli_fetch_assoc($result)) {
          $dupplicate = false;
          $x = 0;
          foreach ($duplicate_array as $key => $value) {
            if ($duplicate_array[$x] == $row["organization_name"]) {
              $dupplicate = true;
            }else {
              $x++;
            }
          }
          if ($dupplicate) {
            // code...
          }else {
            $duplicate_array[0] = $row['organization_name'];

            $row_id = $row["organization_id"];
            $count = 0;
            $count2 = 0;
            $org_name_n_space = str_replace(' ', '', $row['organization_name']);
            foreach (str_split(strtolower($row['organization_name'])) as $id) {
              $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
              $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
              if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                  // no space
                  if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                    $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                    echo "<div class='search-box-container'>";
                    $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                    $final_result_name_uc = ucwords($final_result_name);
                    echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                    echo '<div class="org-logo">
                     <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                     <div class="choice-user">
                     <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                   $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                   $stmt_cart = mysqli_stmt_init($conn);


                   if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                     header("Location: mainpage.php?errorS=sqlerror");
                     exit();
                   }
                   else{
                     mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                     mysqli_stmt_execute($stmt_cart);
                     mysqli_stmt_store_result($stmt_cart);

                     $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                     $z = false;

                       if ($resultCheck >= 1) {
                          echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                         echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                       }else {
                          echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                         // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                     }
                   }

                     echo '</div>
                     </div>';
                    echo '';
                    echo "</div>";
                    break;
                  }
                    // space(s)
                  else {
                    $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                    echo "<div class='search-box-container'>";
                    $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                    $final_result_name_uc = ucwords($final_result_name);
                    echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                    echo '<div class="org-logo">
                     <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                     <div class="choice-user">
                     <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                   $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                   $stmt_cart = mysqli_stmt_init($conn);


                   if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                     header("Location: mainpage.php?errorS=sqlerror");
                     exit();
                   }
                   else{
                     mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                     mysqli_stmt_execute($stmt_cart);
                     mysqli_stmt_store_result($stmt_cart);

                     $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                     $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                   }

                     echo '</div>
                     </div>';
                    echo '';
                    echo "</div>";
                    break;
                  }
              }
              else {
                $count++;
              }
            }
            $row_class++;
          }
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "fdt") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_fight = 'disease'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "lso") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_type = 'large'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "mso") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_type = 'medium'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
      }else if ($_GET["f"] == "sso") {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' checked='check' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";

        $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '') LIKE '%$search%') AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
        LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_type = 'small'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';



                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';



                 }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

                mysqli_close($conn);
        // filter > 1
      }else {
        echo "<br>

        <div class='flex-containers'>
        <div class='left-filter_box'>
        <div class='filter-box-wrapper'>
        <ul class='filter-box'>
          <ul class='filter-row'><h4 class='filter-row-title'>Date</h4>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tmr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Most Recent</span>
                    </a>
                  </label>
                </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=tlr' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Less Recent</span>
                  </a>
                </label>
              </div>
            </li>

          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Fight For</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fht' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Hunger</span>
                </a>
              </label>
            </div>
          </li>


          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=fpt' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Poverty</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fhpt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Hunger and Poverty</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fah' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Abusation</span>
                  </a>
                </label>
              </div>
            </li>

            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=fdt' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Diseases</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Ordered By</h4>

          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=mrp' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Most Popular</span>
                </a>
              </label>
            </div>
          </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=dst' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Donations</span>
                  </a>
                </label>
              </div>
            </li>


            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=lsk' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Likes</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>

          <ul class='filter-row'><h4 class='filter-row-title'>Type</h4>
          <li class='fliter-row-base'>
            <div class='cntr'>
                <label for='cbx' class='label-cbx-filter'>
                <a href='search.php?s=".$simple_search."&f=lso' class='filter-row-base-link'>
                  <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                  <div class='checkbox checkbox_n_p'>
                    <svg class='svg-filter' viewBox='0 0 20 20'>
                      <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                      C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                      <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                    </svg>
                  </div>
                  <span class='checkbox-text'>Large Organizations</span>
                </a>
              </label>
            </div>
          </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=mso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Medium Organizations</span>
                  </a>
                </label>
              </div>
            </li>
            <li class='fliter-row-base'>
              <div class='cntr'>
                  <label for='cbx' class='label-cbx-filter'>
                  <a href='search.php?s=".$simple_search."&f=sso' class='filter-row-base-link'>
                    <input id='cbx' type='checkbox' name='donation-checkbox' class='invisible'>
                    <div class='checkbox checkbox_n_p'>
                      <svg class='svg-filter' viewBox='0 0 20 20'>
                        <path d='M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19
                        C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z'></path>
                        <polyline points='4 11 8 15 16 6' class='poly_check'></polyline>
                      </svg>
                    </div>
                    <span class='checkbox-text'>Small Organizations</span>
                  </a>
                </label>
              </div>
            </li>
          </ul>
        </ul>
        </div>
        </div>
        <div class='organizations_search'>";
        $num_char = strlen($search);
        $space_char = substr_count($search_space, ' ');
        $row_class = 1;

        while ($row = mysqli_fetch_assoc($result)) {

          $row_id = $row["organization_id"];
          $count = 0;
          $count2 = 0;
          $org_name_n_space = str_replace(' ', '', $row['organization_name']);
          foreach (str_split(strtolower($row['organization_name'])) as $id) {
            $num_space_b = substr_count(substr($row['organization_name'],0,$count+1), ' ');
            $org_space_char = substr_count(substr($row['organization_name'],$count,$num_char+$num_space_b), ' ');
            if ((substr(strtolower($org_name_n_space),$count,($num_char)) == strtolower($search)) ) {

                // no space
                if (substr(strtolower($row['organization_name']),($count+$num_space_b),($num_char)) == strtolower($search)) {
                  $bold_replace = mb_substr(strtolower($org_name_n_space),($count),($num_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                   $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                   $stmt_cart = mysqli_stmt_init($conn);


                   if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                     header("Location: mainpage.php?errorS=sqlerror");
                     exit();
                   }
                   else{
                     mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                     mysqli_stmt_execute($stmt_cart);
                     mysqli_stmt_store_result($stmt_cart);

                     $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                     $z = false;

                     if ($resultCheck >= 1) {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                       echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                     }else {
                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';

                       // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';

                     }
                   }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
                  // space(s)
                else {
                  $bold_replace = mb_substr(strtolower($row['organization_name']),$count+$num_space_b,($num_char + $org_space_char));
                  echo "<div class='search-box-container'>";
                  $final_result_name = str_replace(($bold_replace),"<b style='font-weight: 700;'>".strtolower($bold_replace)."</b>",strtolower($row['organization_name']));
                  $final_result_name_uc = ucwords($final_result_name);
                  echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';
                  echo '<div class="org-logo">
                   <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />
                   <div class="choice-user">
                   <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

                 $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
                 $stmt_cart = mysqli_stmt_init($conn);


                 if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
                   header("Location: mainpage.php?errorS=sqlerror");
                   exit();
                 }
                 else{
                   mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
                   mysqli_stmt_execute($stmt_cart);
                   mysqli_stmt_store_result($stmt_cart);

                   $resultCheck = mysqli_stmt_num_rows($stmt_cart);


                   $z = false;

                   if ($resultCheck >= 1) {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';
                     echo "<p class='top_space-marg'>Added to <a href='cart.php'>your cart</a></p>";

                   }else {
                      echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.' full_width-s" id="check-user">Check</button></a>';

                     // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';

                   }
                 }

                   echo '</div>
                   </div>';
                  echo '';
                  echo "</div>";
                  break;
                }
            }
            else {
              $count++;
            }
          }
          $row_class++;
        }
        echo "</div>";

        mysqli_close($conn);
      }
      echo "</div>";


    }else {
      echo "There are no results matching your search";
    }
    echo "</div>";
    echo "</div>";

  }
  ?>
  <script src="jquery.min.js"></script>
  <script type="text/javascript">
  $(document).on("tap click", 'label a', function( event, data ){
  event.stopPropagation();
  event.preventDefault();
  window.open($(this).attr('href'), $(this).attr('target'));
  return false;
});
  </script>


  <script>
  $('.filter_m-bt').on('click', function (e) {

    if($('.filter-box_full-width').hasClass("nagasaki")){

      $('.filter-box_full-width').removeClass('nagasaki');
      $('.top_bconn').removeClass('nagasaki');

    }else {
      $('.filter-box_full-width').addClass('nagasaki');
      $('.top_bconn').addClass('nagasaki');
    }

  });
  </script>
  <script>
  $('body').click(function(evt){
         if(evt.target.id == "m_filter_bid" || evt.target.id == "arr_pos-id")
            return;
         //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
         if($(evt.target).closest('.filter-box_full-width').length)
            return;
            $('.filter-box_full-width').addClass('nagasaki');
            $('.top_bconn').addClass('nagasaki');

        //Do processing of click event here for every element except with id menu_content

  });
  </script>
  <?php
require "pre-footer.php";

require "footer.php";


// filter mobile page same Amz

// echo "
// <div class='main_mobile-containerSF'>
//   <div class='mobile-headerSF'>
//     <div class='frst_SFheader-part'><h4>Back</h4></div>
//     <div class='scnd_SFheader-part'></div>
//   </div>
//   <div class='marg_centr-mobile_container'>
//
//     <div class='m_filter-container'>
//       <div class='m_filter-box'>
//         <h4>Fight for</h4>
//         <div class='filter-mobile_text'><p>Any fight</p></div>
//       </div>
//     </div>
//
//     <div class='m_filter-container'>
//       <div class='m_filter-box'>
//       <h4>Ordered by</h4>
//
//       </div>
//     </div>
//
//   </div>
// </div>
// ";


// top FILTER TRY 1

// <div class='filter_chse-container'>
//   <div class='filter_chse-box-cntner'>
//     <div class='filter_chse-box'>
//       <h5><b>Fight for</b></h5>
//       <h5>Hunger</h5>
//       <h5>Poverty</h5>
//       <h5>Hunger&Poverty</h5>
//       <h5>Abusation</h5>
//       <h5>Diseases</h5>
//
//     </div>
//   </div>
// </div>
