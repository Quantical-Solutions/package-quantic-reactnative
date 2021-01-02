import { StatusBar } from 'expo-status-bar';
import React, { Component } from 'react';
import { StyleSheet, Text, View } from 'react-native';
import { WebView } from 'react-native-webview';

export default class App extends Component {

    render() {

        return (

            <WebView
                source={{ uri: 'https://omnivision.quanticalsolutions.com/' }}
            />
        );
    }
}
