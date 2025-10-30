<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:s="http://www.sitemaps.org/schemas/sitemap/0.9">
    <xsl:template match="/">
        <html>
            <head>
                <meta name="robots" content="noindex" />
                <title>Sitemap</title>
                <style type="text/css">
                    body {
                        background-color: #f8f8f8;
                        color: #666;
                        font-family: system-ui, sans-serif;
                        margin: 0;
                    }

                    .container {
                        margin: 0 auto;
                        padding: 1rem 2rem;
                    }

                    a {
                        outline: none;
                        color: #3498da;
                        text-decoration: none;
                        transition: color 150ms;
                    }

                    a:hover {
                        color: #1a608e;
                    }

                    h1 {
                        margin-top: 0;
                        margin-bottom: 1rem;
                    }

                    table {
                        overflow-x: auto;
                        margin-bottom: 1.5rem;
                        width: 100%;
                        border-collapse: collapse;
                        table-layout: auto;
                    }

                    tbody {
                        font-size: 0.875rem;
                    }

                    th, td {
                        padding: 0.5rem 0.25rem;
                        line-height: 1.5;
                    }

                    th {
                        text-align: left;
                        white-space: nowrap;
                    }

                    tr {
                        border-bottom: 1px solid #e4e4e4;
                    }

                    tr:nth-child(2n) td {
                        background-color: #fff;
                    }
                </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Sitemap</h1>
                        <table>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Location</th>
                                <th>Last Modified</th>
                            </tr>
                            </thead>
                            <tbody>
                            <xsl:for-each select="s:urlset/s:url">
                                <xsl:sort select="s:loc" />
                                <tr>
                                    <xsl:variable name="loc"><xsl:value-of select="s:loc" /></xsl:variable>
                                    <td><xsl:value-of select="position()" /></td>
                                    <td><a href="{$loc}"><xsl:value-of select="s:loc" /></a></td>
                                    <td><xsl:value-of select="s:lastmod" /></td>
                                </tr>
                            </xsl:for-each>
                            </tbody>
                        </table>
                    </div>
                </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
