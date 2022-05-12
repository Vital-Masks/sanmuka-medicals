<?php

function presentPrice($price){
    return 'LKR '.number_format($price / 100, 2);
}