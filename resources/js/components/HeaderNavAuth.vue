<template>
    <nav class="header-nav">
        <ul>
            <li>
                <a :href="routes.user_ordered">注文履歴</a>
            </li>
            <li>
                <a :href="routes.cart">カート</a>
            </li>
            <li>
                <form name="logout_post" method="post" action="routes.logout">
                    <button type="submit" class="logout-post">ログアウト</button>
                </form>
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
                            <a :href="routes.user">マイページ</a>
                        </li>
                        <li>
                            <a :href="routes.user_ordered">注文履歴</a>
                        </li>
                        <li>
                            <a :href="routes.cart">カート</a>
                        </li>
                        <li>
                            <form name="logout_post" method="POST" action="routes.logout">
                                <a href="javascript:logout_post.submit()">ログアウト</a>
                            </form>
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
