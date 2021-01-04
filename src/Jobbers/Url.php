<?php

namespace Quantic\ReactNative\Jobbers;


class Url
{
    private string $arg;
    public array $response;

    public function __construct($arg)
    {
        $this->arg = $arg;
        $this->buildReactNativeFile();
        return $this->response;
    }

    /**
     * Build Files for WebView ReactNative App
     *
     * @return void
     */
    private function buildReactNativeFile()
    {
        $app = "import React, { Component, useState } from 'react';
import { StatusBar } from 'react-native';
import Url from './includes/components/Url';

export default class App extends Component {

    render() {
        return (
            <>
                <StatusBar hidden={false} backgroundColor={'" . config("reactnative.statusBar.backgroundColor") . "'} barStyle={'" . config("reactnative.statusBar.fontColor") . "'} />
                <Url />
            </>
        );
    }
}";

        if ($this->arg !== 'none') {

            if (filter_var($this->arg, FILTER_VALIDATE_URL)) {

                $url = "import React, { Component } from 'react';
import { WebView } from 'react-native-webview';

export default class Url extends Component {
    render() {
        return (
            <>
                <WebView source={{ uri: 'https://omnivision.quanticalsolutions.com' }} />
            </>
        )
    }
}";

                try {

                    $dist = app_path('ReactNative');

                    $ifAppJsExists = $dist . '/App.js';
                    if (file_exists($ifAppJsExists)) {
                        unlink($ifAppJsExists);
                    }

                    $newAppFile = fopen($ifAppJsExists, 'w');
                    fwrite($newAppFile, $app);
                    fclose($newAppFile);

                    $ifUrlJsExists = $dist . '/includes/components/Url.js';
                    if (file_exists($ifUrlJsExists)) {
                        unlink($ifUrlJsExists);
                    }

                    $newUrlFile = fopen($ifUrlJsExists, 'w');
                    fwrite($newUrlFile, $url);
                    fclose($newUrlFile);

                    $this->response = [
                        'type' => 'info',
                        'response' => 'App.js and Url.js have been created successfuly !'
                    ];

                } catch (\ErrorException $e) {

                    $this->response = [
                        'type' => 'warn',
                        'response' => 'Somthing went wrong while creating App.js and Url.js files... !'
                    ];
                }

            } else {

                $this->response = [
                    'type' => 'error',
                    'response' => '"' . $this->arg . '" is not a valid URL !'
                ];
            }

        } else {

            try {

                $dist = app_path('ReactNative');

                $ifAppJsExists = $dist . '/App.js';
                if (file_exists($ifAppJsExists)) {
                    unlink($ifAppJsExists);
                }

                $newAppFile = fopen($ifAppJsExists, 'w');
                fwrite($newAppFile, $app);
                fclose($newAppFile);

                $this->response = [
                    'type' => 'info',
                    'response' => 'App.js has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->response = [
                    'type' => 'error',
                    'response' => 'Somthing went wrong while creating App.js file... !'
                ];
            }
        }
    }
}