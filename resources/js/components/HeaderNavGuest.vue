<template>
    <nav class="header-nav">
        <ul>
            <li>
                <a :href="routes.register">会員登録</a>
            </li>
            <li>
                <a :href="routes.cart">カート</a>
            </li>
            <li>
                <a :href="routes.login">ログイン</a>
            </li>
            <li class="hamburger">
                <div class="hambuger-btn" @click="hamToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="hambuger-menu" v-show="showHam">
                    <ul>
                        <li>
                            <a :href="routes.register">会員登録</a>
                        </li>
                        <li>
                            <a :href="routes.cart">カート</a>
                        </li>
                        <li>
                            <a :href="routes.login">ログイン</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        routes: {}
    },
    data() {
        return {
            showHam: false
        }
    },
    methods: {
        hamToggle() {
            this.showHam = !this.showHam
            console.log(this.showHam)
        }
    }
}
</script>
