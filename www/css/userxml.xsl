<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <div class="title"><span class="title_icon"><img
                    src="&lt;?= base_url ?&gt;/www/img/books/bullet1.gif" alt="" title=""
            /></span>Possible Books</div>
        <div class="new_products">
            <xsl:for-each select="userquery/book">
                <div class="new_prod_box">
                    <div class="new_prod_bg">
                        <a href='&lt;?= base_url ?&gt;/book/detail/&lt;xsl:value-of select="id"'>
                            <img
                                src='&lt;?= base_url ?&gt;/www/img/books/&lt;xsl:value-of select="image"/&gt;'
                                border="0" width="60" height="100"/>
                        </a>
                        <br/>
                        <a href="details.php">
                            <xsl:value-of select="title"/>
                        </a>
                        <br/>
                    </div>
                </div>
            </xsl:for-each>
        </div>
        <div class="clear"/>
    </xsl:template>
</xsl:stylesheet>
<!--end of left content-->
