<?php

namespace Quantic\ReactNative\Jobbers;


class Url
{
    private string $arg;
    public array $response; // return CLI message

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
        $app = "import React, { Component } from 'react';
import {StatusBar, View, StyleSheet} from 'react-native';
import {Url} from './includes/components/Url';

export default class App extends Component {

    render() {
        return (
            <View style={styles.container}>
                <StatusBar hidden={false} backgroundColor={'" . config("reactnative.statusBar.backgroundColor") . "'} barStyle={'" . config("reactnative.statusBar.fontColor") . "'} />
                <Url />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1
    }
});";

        if ($this->arg !== 'none') {

            if (filter_var($this->arg, FILTER_VALIDATE_URL)) {

                $url = "import React from 'react';
import { WebView } from 'react-native-webview';
import {Text, View, StyleSheet} from 'react-native';
import {useNetInfo} from '@react-native-community/netinfo';
import Logo from '../../assets/not-connected.svg';

export const Url = () => {
    const netInfo = useNetInfo();

    return (
        <>
            { netInfo.type === 'wifi' ?
                <WebView source={{ uri: '" . $this->arg . "' }} />
            :
                <View style={styles.view}>
                    <Logo style={styles.logo} />
                    <Text style={styles.text}>Connexion lost...</Text>
                    <Text style={styles.small}>
                        Internet is required to continue browsing</Text>
                </View>
            }
        </>
    )
}

const styles = StyleSheet.create({
    view: {
        flex: 1,
        backgroundColor: '#000',
        justifyContent: 'center',
        alignItems: 'center'
    },
    text: {
        color: 'white',
        fontWeight: 'bold',
        fontSize: 30,
    },
    small: {
        color: 'gray',
        fontSize: 14,
    },
    logo: {
        width: 80,
        height: 80
    }
});";

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