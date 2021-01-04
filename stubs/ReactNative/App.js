import React, { Component } from 'react';
import {StatusBar, View, StyleSheet} from 'react-native';
import {Url} from './includes/components/Url';

export default class App extends Component {

    render() {
        return (
            <View style={styles.container}>
                <StatusBar hidden={false} backgroundColor={'#FFF'} barStyle={'dark-content'} />
                <Url />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1
    }
});