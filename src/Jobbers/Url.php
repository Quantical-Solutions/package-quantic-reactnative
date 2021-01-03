<?php

namespace Quantic\ReactNative\Jobbers;


class Url
{
    private string $arg;
    public array $response;

    public function __construct($arg)
    {
        $this->arg = $arg;
        $this->buildAppFile();
        return $this->response;
    }

    private function buildAppFile()
    {
        if (filter_var($this->arg, FILTER_VALIDATE_URL)) {

            $js = "import { StatusBar } from 'expo-status-bar';
import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import { WebView } from 'react-native-webview';

export default class App extends Component {

    render() {

        return (

            <WebView
                source={{ uri: '" . $this->arg . "' }}
            />
        );
    }
}";

            try {

                $dist = app_path('ReactNative');

                $ifAppJsExists = $dist . '/App.js';
                if (file_exists($ifAppJsExists)) {
                    unlink($ifAppJsExists);
                }

                $newAppFile = fopen($ifAppJsExists, 'w');
                fwrite($newAppFile, $js);
                fclose($newAppFile);

                $this->response = [
                    'type' => 'info',
                    'response' => 'App.js has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->response = [
                    'type' => 'warn',
                    'response' => 'Somthing went wrong while creating App.js file... !'
                ];
            }

        } else {

            $this->response = [
                'type' => 'error',
                'response' => '"' . $this->arg . '" is not a valid URL !'
            ];
        }
    }
}