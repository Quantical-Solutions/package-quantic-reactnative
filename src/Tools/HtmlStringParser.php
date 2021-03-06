<?php

namespace Quantic\ReactNative\Tools;

class HtmlStringParser
{
    private string $head;
    private string $footer;
    public array $result;
    
    public function buildCapsule($arg)
    {
        $headStyles = $headLibs = $footerScripts = '';
        
        $styles = app_path('ReactNative/assets/dist/styles.css');
        if (file_exists($styles)) {
            ob_start();
            require $styles;
            $headStyles = ob_get_clean();
        }

        $libs = app_path('ReactNative/assets/dist/libs.js');
        if (file_exists($libs)) {
            ob_start();
            require $libs;
            $headLibs = ob_get_clean();
        }

        $scripts = app_path('ReactNative/assets/dist/scripts.js');
        if (file_exists($scripts)) {
            ob_start();
            require $scripts;
            $footerScripts = ob_get_clean();
        }

        ob_start();
        require dirname(dirname(__DIR__)) . '/stubs/templates/head.template.php';
        $this->head = ob_get_clean();

        ob_start();
        require dirname(dirname(__DIR__)) . '/stubs/templates/footer.template.php';
        $this->footer = ob_get_clean();

        $this->renderComponents($arg);
    }
    
    private function renderComponents($arg)
    {
        $dist = app_path('ReactNative/includes/common');

        if ($arg === 'head') {

            try {

                $ifHeadExists = $dist . '/head.html';
                if (file_exists($ifHeadExists)) {
                    unlink($ifHeadExists);
                }

                $newHead = fopen($ifHeadExists, 'w');
                fwrite($newHead, $this->head);
                fclose($newHead);

                $this->result = [
                    'type' => 'info',
                    'response' => 'head.html has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create head.html in ReactNative includes/common folder...'
                ];
            }

        } else if ($arg === 'footer') {

            try {

                $ifFooterExists = $dist . '/footer.html';
                if (file_exists($ifFooterExists)) {
                    unlink($ifFooterExists);
                }

                $newFooter = fopen($ifFooterExists, 'w');
                fwrite($newFooter, $this->footer);
                fclose($newFooter);

                $this->result = [
                    'type' => 'info',
                    'response' => 'footer.html has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create footer.html in ReactNative includes/common folder...'
                ];
            }

        } else if ($arg === 'all') {

            try {

                $ifHeadExists = $dist . '/head.html';
                if (file_exists($ifHeadExists)) {
                    unlink($ifHeadExists);
                }

                $newHead = fopen($ifHeadExists, 'w');
                fwrite($newHead, $this->head);
                fclose($newHead);

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create head.html in ReactNative includes/common folder...'
                ];
            }

            try {

                $ifFooterExists = $dist . '/footer.html';
                if (file_exists($ifFooterExists)) {
                    unlink($ifFooterExists);
                }

                $newFooter = fopen($ifFooterExists, 'w');
                fwrite($newFooter, $this->footer);
                fclose($newFooter);

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create footer.html in ReactNative includes/common folder...'
                ];
            }

            $this->result = [
                'type' => 'info',
                'response' => 'head.html and footer.html have been created successfuly !'
            ];

        } else if ($arg === 'navigation') {

            $base = app_path('ReactNative');

            try {

                $ifAppExists = $base . '/App.js';
                if (file_exists($ifAppExists)) {
                    unlink($ifAppExists);
                }

                $app = "import React, { Component } from 'react';
import {StatusBar, View, StyleSheet} from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';

function HomeScreen() {
  return (
    <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
      <Text>Home Screen</Text>
    </View>
  );
}

const Stack = createStackNavigator();

export default class App extends Component {

    render() {
        return (
            <View style={styles.container}>
                <StatusBar hidden={false} backgroundColor={'" . config("reactnative.statusBar.backgroundColor") . "'} barStyle={'" . config("reactnative.statusBar.fontColor") . "'} />
                <NavigationContainer>
                    <Stack.Navigator>
                        <Stack.Screen name='Home' component={HomeScreen} />
                    </Stack.Navigator>
                </NavigationContainer>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1
    }
});";

                $newApp = fopen($ifAppExists, 'w');
                fwrite($newApp, $app);
                fclose($newApp);

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create the Navigation Stack...'
                ];
            }

            $this->result = [
                'type' => 'info',
                'response' => 'Navigaton Stack has been created successfuly !'
            ];

        } else {

            $this->result = [
                'type' => 'warn',
                'response' => '"' . $arg . '" argument is not available. You mean "head", "footer" or "all" ?'
            ];
        }
    }
}
