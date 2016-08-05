<template>
    <template v-if="banner.pic" v-cloak>
        <a href="/mobile/area/@{{ banner.id }}">
            <div class="banner">
                <div class="cover-photo">
                    <img :src="banner.pic" width="100%" alt="">
                </div>
                <div class="guide-mess">
                    <h1>@{{ banner.title }}</h1>
                    <p>@{{ banner.mess }}</p>
                </div>
            </div>
        </a>
    </template>

        <div class="content">
            <label id="tm">选择城市</label>
            <section id="casa-list">
                <template v-for="casa in casas" block transition="expand">
                    <div class="card">
                        <a href="/mobile/casa/@{{ casa.id }}">
                            <img :src="casa.pic" width="100%" alt="@{{ casa.pic }}">
                            <h3>@{{ casa.name }}</h3>
                            <p>标签：
                                <template v-for="tag in casa.tags" v-cloak>
                                    <template v-if="$index < 3">
                                        <span class="tip">@{{ tag.name }}</span>
                                    </template>
                                </template>
                            </p>
                        </a>
                    </div>
                </template>
                <div class="loader" style="display: none">
                    <div class="loader-inner line-scale">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="no-more">
                    没有更多了
                </div>
            </section>
        </div>
        </div>
    </div>
</template>