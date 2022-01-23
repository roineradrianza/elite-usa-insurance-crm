<template v-if="n.post_type == 'quote_doc_r' && parseInt(n.status) == 2">
    Document <b>{{ n.post_title }}</b> has been received
</template>
<template v-else-if="n.post_type == 'quote_doc_r' && parseInt(n.status) == 3">
    Document <b>{{ n.post_title }}</b> is being processing
</template>
<template v-else-if="n.post_type == 'quote_form_mr'">
    Quote modification has been requested: <b>{{ n.post_content }}</b>
</template>
<template v-else-if="n.post_type == 'quote_a_doc'">
    Document <b>{{ n.post_title }}</b> attached by the agent
</template>