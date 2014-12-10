<?php

function makepassword($length)
                        {
                            $validCharacters = "abcdefghijklmnopqrstuvwxyz123456789";
                            $validCharNumber = strlen($validCharacters);
                            $result = '';
                            for ($i = 0; $i < $length; $i++)
                            {
                                $result .= $validCharacters[mt_rand(0, $validCharNumber - 1)];
                            }
                            return $result;
                        }
                        $random_password = makepassword(10);
