<?php
function filterReq($reqname)
{
    return htmlspecialchars(strip_tags($_POST[$reqname]));
}
function printFail($msg)
{
  echo json_encode(array("status"=> "fail","msg"=>$msg));

}