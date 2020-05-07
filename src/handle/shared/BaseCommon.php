<?php

function base_url($model)
{
  $url = array(
    "moderations" => "https://api.posmoni.com/api/v1/moderations"
  );

    return $url[$model];
}
