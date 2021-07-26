<template v-if="n.post_type == 'quote_doc_r'">
    Document <b>{{ n.post_title }}</b> has been requested
</template><template v-if="n.post_type == 'quote_data_r'">
    Information <b>{{ n.post_title }}</b> has been requested
</template>